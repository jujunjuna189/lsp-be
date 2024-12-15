<?php

namespace App\Http\Controllers\Api\v1\Schema;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Api\v1\Schema\SchemaModel;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class SchemaController extends BaseController
{
    public function show(Request $request)
    {
        $schema = QueryBuilder::for(SchemaModel::class)
            ->paginate($request->perpage, ['*'], 'page', $request->page)->appends(request()->query());

        return $this->successResponse('Success show service comment', [
            'schema' => $schema,
        ]);
    }

    public function detail(Request $request)
    {
        $schema = SchemaModel::find($request->id);

        return $this->successResponse('Success show service comment', [
            'schema' => $schema,
        ]);
    }

    public function create(Request $request)
    {
        $schema = new SchemaModel();
        $schema->fill($request->except('id'));
        $schema->save();

        return $this->successResponse('Success create schema', [
            'schema' => $schema,
        ]);
    }

    public function update(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }
}
