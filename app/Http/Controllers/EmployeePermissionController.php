<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeePermissionController extends Controller
{
    /**
     * Form pengajuan izin
     */
    public function create()
    {
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        return view('employee.permission', compact('employee'));
    }

    /**
     * Simpan izin + bukti
     */
    public function store(Request $request)
    {
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'note'  => 'nullable|string|max:255',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // simpan file bukti
        $path = $request->file('proof')->store(
            'permissions',
            'public'
        );

        // buat / update absensi hari ini
        Attendance::updateOrCreate(
            [
                'employee_id' => $employee->id,
                'date'        => today(),
            ],
            [
                'company_id' => $employee->company_id,
                'status'     => 'izin',
                'note'       => $request->note,
                'proof'      => $path,
            ]
        );

        return redirect()
            ->route('employee.dashboard')
            ->with('success', 'Izin berhasil dikirim, menunggu persetujuan admin.');
    }
}
