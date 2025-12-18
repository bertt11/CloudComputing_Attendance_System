<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class PermissionApprovalController extends Controller
{
    /**
     * List izin pending
     */
    public function index()
    {
        $permissions = Attendance::with(['employee.user', 'company'])
            ->where('status', 'pending_izin')
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Approve izin
     */
    public function approve(Attendance $attendance)
    {
        $attendance->update([
            'status' => 'izin',
        ]);

        return back()->with('success', 'Izin disetujui.');
    }

    /**
     * Reject izin
     */
    public function reject(Attendance $attendance)
    {
        $attendance->update([
            'status' => 'absen',
        ]);

        return back()->with('success', 'Izin ditolak.');
    }
}
