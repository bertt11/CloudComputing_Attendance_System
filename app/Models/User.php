<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
        protected $fillable = [
        'name',
        'email',
        'uid',
        'password',
        'role',
        'company_id'
    ];

    /**
     * Relasi:
     * Admin / Employee -> milik 1 company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relasi:
     * Owner -> punya banyak company
     */
    public function companies()
    {
        return $this->hasMany(Company::class, 'owner_id');
    }

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
