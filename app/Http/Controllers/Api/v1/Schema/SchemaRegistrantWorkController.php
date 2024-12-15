<?php

namespace App\Http\Controllers\Api\v1\Schema;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\v1\Schema\SchemaRegistrantWorkModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchemaRegistrantWorkController extends BaseController
{
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $schema = new SchemaRegistrantWorkModel();
            $schema->fill($request->except('id'));
            $schema->save();

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
