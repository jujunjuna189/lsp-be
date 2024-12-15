<?php

namespace App\Http\Controllers\Api\v1\Schema;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\v1\Schema\SchemaRegistrantModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\QueryBuilder;

class SchemaRegistrantController extends BaseController
{
    public function show(Request $request)
    {
        $model = QueryBuilder::for(SchemaRegistrantModel::class)
            ->with('schemaRegistrantWorkModel')
            ->orderBy('id', 'desc')
            ->paginate($request->perpage, ['*'], 'page', $request->page)->appends(request()->query());

        return $this->successResponse('Success show schema registrant', [
            'schema_registrant' => $model,
        ]);
    }

    public function detail(Request $request)
    {
        $model = SchemaRegistrantModel::where('id', $request->id)->with('schemaModel', 'schemaRegistrantWorkModel', 'schemaRegistrantDocumentModel', 'schemaRegistrantAssesmentModel')->first();

        return $this->successResponse('Success show schema registrant', [
            'schema_registrant' => $model,
        ]);
    }

    public function createValidation($request)
    {
        switch ($request->step) {
            case 0:
                $validator = Validator::make(
                    $request->all(),
                    SchemaRegistrantModel::$storeRules,
                    SchemaRegistrantModel::$messageRules
                );
                break;
            case 1:
                $validator = Validator::make($request->all(), ['step' => ['required']]);
                break;
            default:
                $validator = Validator::make($request->all(), ['step' => ['required']]);
                break;
        }

        return $validator;
    }

    public function create(Request $request)
    {
        $validator = $this->createValidation($request);
        if ($validator->fails()) {
            return $this->badRequestResponse('Input tidak sesuai', $validator->messages());
        }

        if ($request->step < 2) return;

        try {
            DB::beginTransaction();
            $schema = new SchemaRegistrantModel();
            $schema->fill($request->except('id'));
            $schema->save();

            // Create work
            $work = new SchemaRegistrantWorkController;
            $work->create(new Request([
                'schema_registrant_id' => $schema->id,
                'company_name' => $request->company_name,
                'position' => $request->company_position,
                'address' => $request->company_address,
                'email' => $request->company_email,
                'telp' => $request->company_telp
            ]));

            // Create document
            $document = $request->document_array ?? [];
            foreach ($document as $index => $val) {
                if (isset($val['file']['file'])) {
                    $document_new = new SchemaRegistrantDocumentController;

                    $new_request = new Request();
                    $new_request->merge(['file' => $val['file']['file']]);
                    $new_request->merge(['name' => $val['key']]);

                    $document_new->create(new Request([
                        'schema_registrant_id' => $schema->id,
                        'title' => $val['title'],
                        'file' => $this->upload_image_base_64($new_request, 'schema_registrant/document'),
                    ]));
                }
            }

            // Create assesment
            $assesment = json_decode($request->assesment) ?? [];
            foreach ($assesment as $val) {
                $assesment_new = new SchemaRegistrantAssesmentController;
                $assesment_new->create(new Request([
                    'schema_registrant_id' => $schema->id,
                    'schema_unit_code' => $val->schema_unit_code,
                    'title' => $val->title,
                    'k' => $val->k,
                    'bk' => $val->bk,
                    'proof' => $val->proof->title ?? '',
                    'is_heading' => $val->is_heading,
                    'order' => $val->order,
                ]));
            }


            DB::commit();
            return $this->successResponse('Success create schema', [
                'schema' => $schema,
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return $this->serverErrorResponse('Error create schema', []);
        }
    }
}
