<?php

namespace App\Http\Controllers\Api\v1\Schema;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\v1\Schema\SchemaUnitModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SchemaUnitController extends BaseController
{
    public function show(Request $request)
    {
        $schema_unit = QueryBuilder::for(SchemaUnitModel::class)->allowedFilters([AllowedFilter::exact('schema_id')])->get();

        return $this->successResponse('Success show schema unit ', [
            'schema_unit' => $schema_unit,
        ]);
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $schema_unit = new SchemaUnitModel();
            $schema_unit->fill($request->except('id'));
            $schema_unit->save();

            DB::commit();
            return $this->successResponse('Success create schema unit', [
                'schema_unit' => $schema_unit,
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return $this->serverErrorResponse('Error create schema', []);
        }
    }
}
