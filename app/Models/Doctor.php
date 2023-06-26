<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public static function getRecordById($id)
    {
        $record =  Doctor::where('id', $id)->first();
        return $record ?? null;
    }
}
