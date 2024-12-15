<?php

namespace App\Models\Api\v1\Schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemaModel extends Model
{
    use HasFactory;

    protected $table = 'schema';
    protected $guarded = ['id'];
    protected $appends = ['purpose_decode'];

    public function getPurposeDecodeAttribute()
    {
        return json_decode($this->purpose);
    }
}
