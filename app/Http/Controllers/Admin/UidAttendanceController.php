<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;

class UidAttendanceController extends Controller
{
    /**
     * Form input UID
     */
    public function create()
    {
        return view('admin.attendances.uid');
    }

    /**
     * Proses absen via UID
     */
    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'required|string'
        ]);

        // Cari user berdasarkan UID
        $user = User::where('uid', $request->uid)->first();

        if (!$user || !$user->employee) {
            return back()->with('error', 'UID tidak ditemukan');
        }

        // Cek absensi hari ini
        Attendance::updateOrCreate(
            [
                'employee_id' => $user->employee->id,
                'date' => now()->toDateString(),
            ],
            [
                'status' => 'hadir',
            ]
        );

        return back()->with('success', 'Absensi berhasil dicatat');
    }
}
