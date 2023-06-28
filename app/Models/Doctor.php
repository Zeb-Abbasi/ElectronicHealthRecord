<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;
    // protected $guard = 'doctor';
    protected $fillable = [
        'address',
        'fees',
        'contact_no',
        'specialization',
        'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getRecordById($id)
    {
        $record =  Doctor::where('id', $id)->first();
        return $record ?? null;
    }
}
