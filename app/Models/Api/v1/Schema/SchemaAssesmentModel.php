<?php

namespace App\Models\Api\v1\Schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemaAssesmentModel extends Model
{
    use HasFactory;

    protected $table = 'schema_assesment';
    protected $guarded = ['id'];
}
