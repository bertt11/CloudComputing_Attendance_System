<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    use HasFactory;
    protected $fillable = ['name','password'];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}
