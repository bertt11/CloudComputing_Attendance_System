<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ambil employee yang terkait dengan user login
        $employee = Employee::where('user_id', $user->id)->firstOrFail();

        // absensi hari ini (jika sudah ada)
        $todayAttendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->first();

        return view('employee.dashboard', compact(
            'employee',
            'todayAttendance'
        ));
    }
}
