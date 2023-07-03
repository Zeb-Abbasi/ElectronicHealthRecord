<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        public function roles()
        {
            return $this->belongsToMany(Role::class);
        }

        public function hasRole($roles)
        {
            if (is_array($roles)) {
                return $this->roles()->whereIn('name', $roles)->exists();
            }

            return $this->roles()->where('name', $roles)->exists();
        }

        public function doctors(): HasMany
        {
            return $this->hasMany(Doctor::class);
        }

        public function patients(): HasMany
        {
            return $this->hasMany(Patient::class);
        }
}
