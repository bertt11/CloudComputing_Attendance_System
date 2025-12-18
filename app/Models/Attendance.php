<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'employee_id',
        'date',
        'status',
        'proof_file',
        'note',
    ];
    
     protected $casts = [
        'date' => 'date',
    ];

    /**
     * Relasi ke Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relasi ke Employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
