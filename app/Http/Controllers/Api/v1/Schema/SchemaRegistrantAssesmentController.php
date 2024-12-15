<?php

namespace App\Http\Controllers\Api\v1\Schema;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\v1\Schema\SchemaRegistrantAssesmentModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchemaRegistrantAssesmentController extends BaseController
{
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $schema_assesment = new SchemaRegistrantAssesmentModel();
            $schema_assesment->fill($request->except('id'));
            $schema_assesment->save();

            DB::commit();
            return $this->successResponse('Success create schema_assesment', [
                'schema_assesment' => $schema_assesment,
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return $this->serverErrorResponse('Error create schema_assesment', []);
        }
    }
}
