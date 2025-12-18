<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        $company = $admin->company;

        // Ambil semua karyawan company admin
        $employees = Employee::where('company_id', $company->id)->get();

        /**
         * Pastikan SETIAP karyawan punya absensi hari ini
         * (logic bisnis HARUS di controller)
         */
        foreach ($employees as $emp) {
            Attendance::firstOrCreate(
                [
                    'employee_id' => $emp->id,
                    'date' => today(),
                ],
                [
                    'company_id' => $company->id,
                    'status' => 'absen',
                ]
            );
        }

        // Reload relasi attendance hari ini
        $employees->load([
            'attendances' => function ($q) {
                $q->whereDate('date', today());
            }
        ]);

        return view('admin.attendances.index', compact(
            'company',
            'employees'
        ));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,absen',
        ]);

        $attendance->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status absensi diperbarui');
    }
}
