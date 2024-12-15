<?php

namespace App\Models\Api\v1\Schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemaRegistrantWorkModel extends Model
{
    use HasFactory;

    protected $table = 'schema_registrant_work';
    protected $guarded = ['id'];
}
