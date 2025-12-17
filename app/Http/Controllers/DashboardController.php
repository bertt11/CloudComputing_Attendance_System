<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // total perusahaan milik owner
        $companyCount = Company::where('owner_id', $user->id)->count();

        // total karyawan dari semua perusahaan owner
        $employeeCount = Employee::whereIn(
            'company_id',
            Company::where('owner_id', $user->id)->pluck('id')
        )->count();

        // absensi hari ini (dari semua perusahaan owner)
        $todayAttendance = Attendance::whereIn(
            'company_id',
            Company::where('owner_id', $user->id)->pluck('id')
        )->whereDate('date', today())->count();

        return view('owner.dashboard', compact(
            'companyCount',
            'employeeCount',
            'todayAttendance'
        ));
    }
}
