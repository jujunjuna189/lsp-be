<?php

namespace App\Http\Controllers\Api\v1\Schema;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\v1\Schema\SchemaRegistrantDocumentModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchemaRegistrantDocumentController extends BaseController
{
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $schema_document = new SchemaRegistrantDocumentModel();
            $schema_document->fill($request->except('id'));
            $schema_document->save();

            DB::commit();
            return $this->successResponse('Success create schema_document', [
                'schema_document' => $schema_document,
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return $this->serverErrorResponse('Error create schema_document', []);
        }
    }
}
