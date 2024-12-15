<?php

namespace App\Http\Controllers\Api\v1\Schema;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\v1\Schema\SchemaAssesmentModel;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class SchemaAssesmentController extends BaseController
{
    public function show()
    {
        $schema_assesment = QueryBuilder::for(SchemaAssesmentModel::class)->allowedFilters(['schema_id'])->get();

        return $this->successResponse('Success show schema assesment ', [
            'schema_assesment' => $schema_assesment,
        ]);
    }
}
