<?php
namespace App\Services;

use App\Models\Employee;
use App\Models\Attendance;

class AttendanceService
{
    public static function ensureTodayAttendance($companyId)
    {
        $employees = Employee::where('company_id', $companyId)->get();

        foreach ($employees as $emp) {
            Attendance::firstOrCreate(
                [
                    'employee_id' => $emp->id,
                    'date' => today(),
                ],
                [
                    'company_id' => $emp->company_id,
                    'status' => 'absen',
                ]
            );
        }
    }
}
