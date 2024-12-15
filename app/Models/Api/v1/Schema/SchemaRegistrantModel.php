<?php

namespace App\Models\Api\v1\Schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemaRegistrantModel extends Model
{
    use HasFactory;

    protected $table = 'schema_registrant';
    protected $guarded = ['id'];

    public static $storeRules = [
        'name' => ['string', 'required'],
        'no_identity' => ['required', 'min:14', 'max:16'],
        'place_of_birth' => ['required'],
        'date_of_birth' => ['required'],
        'gender' => ['required'],
        'nationality' => ['required'],
        'address' => ['required'],
        'telp' => ['required'],
        'email' => ['required', 'email'],
        'education' => ['required'],
        'company_name' => ['required'],
        'company_position' => ['required'],
        'company_address' => ['required'],
        'company_telp' => ['required'],
        'company_email' => ['required', 'email'],
    ];

    public static $messageRules = [
        'required' => ':attribute harus diisi',
        'email' => ':attribute masukan harus berupa email',
        'string' => ':attribute masukan harus berupa teks',
        'no_identity.min' => ':attribute minimal 14 karakter',
        'no_identity.max' => ':attribute maximal 16 karakter',
    ];

    public function schemaModel()
    {
        return $this->hasOne(SchemaModel::class, 'id', 'schema_id');
    }

    public function schemaRegistrantWorkModel()
    {
        return $this->hasOne(SchemaRegistrantWorkModel::class, 'schema_registrant_id', 'id');
    }

    public function schemaRegistrantDocumentModel()
    {
        return $this->hasMany(SchemaRegistrantDocumentModel::class, 'schema_registrant_id', 'id');
    }

    public function schemaRegistrantAssesmentModel()
    {
        return $this->hasMany(SchemaRegistrantAssesmentModel::class, 'schema_registrant_id', 'id');
    }
}
