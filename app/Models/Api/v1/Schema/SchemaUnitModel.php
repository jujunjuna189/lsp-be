<?php

namespace App\Models\Api\v1\Schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemaUnitModel extends Model
{
    use HasFactory;

    protected $table = 'schema_units';
    protected $guarded = ['id'];
}
