<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialization extends Model
{
    use HasFactory;
    protected $fillable = [
        'specialization',
    ];
    public static function getRecordById($id)
    {
        $record =  DoctorSpecialization::where('id', $id)->first();
        return $record ?? null;
    }
}
