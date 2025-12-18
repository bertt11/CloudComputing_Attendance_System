<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'owner_id',
    ];

    /**
     * Relasi:
     * Company dimiliki oleh 1 owner
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Relasi:
     * Company punya banyak user (admin & employee)
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }


}
