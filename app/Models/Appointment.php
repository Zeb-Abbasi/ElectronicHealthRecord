<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_specialization',
        'doctor_id',
        'patient_id',
        'consultancy_fees',
        'appointment_date',
        'appointment_time',
        'posting_date',
        'patient_status',
        'doctor_status'
    ];
}
