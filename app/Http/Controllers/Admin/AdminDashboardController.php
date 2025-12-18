<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        // asumsi admin terikat ke 1 company
        $companyId = $admin->company_id;

        $totalEmployees = Employee::where('company_id', $companyId)->count();

        $izinCount = Attendance::where('company_id', $companyId)
            ->where('status', 'pending_izin')
            ->whereDate('date', today())
            ->count();

        $absenCount = Attendance::where('company_id', $companyId)
            ->where('status', 'absen')
            ->whereDate('date', today())
            ->count();

        return view('admin.dashboard', compact(
            'totalEmployees',
            'izinCount',
            'absenCount'
        ));
    }
}
