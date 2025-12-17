<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Company $company)
    {
        // admin hanya boleh lihat perusahaannya sendiri
        if ($company->id !== Auth::user()->company_id) {
            abort(403);
        }

        $employees = $company->employees()->with([
            'attendances' => function ($q) {
                $q->whereDate('date', today());
            }
        ])->get();

        return view('admin.attendances.index', compact('company', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,absen',
        ]);

        $attendance->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status absensi diperbarui');
    }
}
