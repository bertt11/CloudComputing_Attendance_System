<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Services\AttendanceService;

class DashboardController extends Controller
{
    public function index()
    {
        $ownerId = Auth::id();

        // Ambil semua perusahaan milik owner
        $companies = Company::where('owner_id', $ownerId)->get();
        $companyIds = $companies->pluck('id');

        foreach ($companyIds as $companyId) {
            AttendanceService::ensureTodayAttendance($companyId);
        }

        $companyCount = $companyIds->count();

        $employeeCount = Employee::whereIn('company_id', $companyIds)->count();

        $today = today();

        $hadirToday = Attendance::whereIn('company_id', $companyIds)
            ->whereDate('date', $today)
            ->where('status', 'hadir')
            ->count();

        $izinToday = Attendance::whereIn('company_id', $companyIds)
            ->where('status', 'izin')
            ->whereDate('date', $today)
            ->count();

        $absenToday = Attendance::whereIn('company_id', $companyIds)
            ->where('status', 'absen')
            ->whereDate('date', $today)
            ->count();

        return view('owner.dashboard', compact(
            'companyCount',
            'employeeCount',
            'hadirToday',
            'izinToday',
            'absenToday'
        ));
    }
}
