<?php

namespace App\Models\Api\v1\Schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemaRegistrantDocumentModel extends Model
{
    use HasFactory;

    protected $table = 'schema_registrant_document';
    protected $guarded = ['id'];
    protected $appends = ['file_decode'];

    public function getFileDecodeAttribute()
    {
        return url('') . '/' . $this->file;
    }
}
