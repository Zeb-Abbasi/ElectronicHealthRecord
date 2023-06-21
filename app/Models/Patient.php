<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'doctor_id',
        'email',
        'password',
        'contact_no',
        'address',
        'gender',
        'age',
        'med_his',
        'image',
        'role_id',
    ];
    public static function getRecordById($id)
    {
        $record =  Patient::where('id', $id)->first();
        return $record ?? null;
    }
}
