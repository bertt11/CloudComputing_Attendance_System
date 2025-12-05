<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
    use HasFactory;
    protected $fillable = [
        'company_id','employee_id','status','time','note','file_path','uid'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
