<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'diagnosis',
        'blood_pressure',
        'blood_sugar',
        'weight',
        'temperature',
        'treatment',
        'admission_date',
        'discharge_date'
    ];

}
