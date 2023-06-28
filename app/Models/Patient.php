<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
    use HasFactory;
    protected $guard = 'patient';
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

        public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public static function getRecordById($id)
    {
        $record =  Patient::where('id', $id)->first();
        return $record ?? null;
    }
}
