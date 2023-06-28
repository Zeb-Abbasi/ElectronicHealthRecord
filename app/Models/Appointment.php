<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function getFormattedAppointmentTimeAttribute()
    {
        $formattedDate = Carbon::parse($this->appointment_time)->format('Y-m-d');
        $formattedTime = Carbon::parse($this->appointment_time)->format('h:i A');

        return $formattedDate . ' / ' . $formattedTime;
    }
}
