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
            'reject_reason' => null,
        ]);

        return back()->with('success', 'Izin berhasil disetujui');
    }

    public function reject(Request $request, Attendance $attendance)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:255',
        ]);

        $attendance->update([
            'status' => 'absen',
            'reject_reason' => $request->reject_reason,
        ]);

        return back()->with('success', 'Izin ditolak');
    }

}
