<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            // 1. Update database
            $attendance->update([
                'status' => 'izin',
                'approved_at' => now(),
                'rejected_reason' => null,
            ]);

            // 2. Kirim data ke AWS API Gateway
            $response = Http::post(
                config('services.aws_email.endpoint'),
                [
                    'email'   => $attendance->employee->user->email,
                    'name'    => $attendance->employee->name,
                    'status'  => 'DISETUJUI',
                    'date'    => now()->format('d M Y'),
                    'message' => 'Izin kamu telah disetujui admin'
                ]
            );

            // 3. Log (opsional tapi penting buat sidang)
            logger()->info('AWS EMAIL RESPONSE', $response->json());

            return back()->with('success', 'Izin disetujui & request email dikirim ke AWS');
        }


            public function reject(Request $request, Attendance $attendance)
        {
            $request->validate([
                'reject_reason' => 'required|string|max:255',
            ]);

            $attendance->update([
                'status' => 'absen',
                'rejected_reason' => $request->reject_reason,
            ]);

            Http::post(
                config('services.aws_email.endpoint'),
                [
                    'email'   => $attendance->employee->user->email,
                    'name'    => $attendance->employee->name,
                    'status'  => 'DITOLAK',
                    'date'    => now()->format('d M Y'),
                    'message' => $request->reject_reason,
                ]
            );

            return back()->with('success', 'Izin ditolak & request email dikirim ke AWS');
        }


    

}
