<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class UidAttendanceController extends Controller
{
    /**
     * FORM UI ADMIN
            */

        public function create()
        {
            $lastAttendance = Attendance::with('employee.user')
                ->latest()
                ->first();

            return view('admin.attendances.uid', compact('lastAttendance'));
        }


    /**
     * DARI FORM MANUAL (ADMIN)
     */
    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'required|string'
        ]);

        return $this->processUid($request->uid, true);
    }

    /**
     * DARI IOT (AWS LAMBDA)
     */
    public function storeFromIoT(Request $request)
    {
        if ($request->header('x-api-key') !== config('services.iot.api_key')) {
            return response()->json(['success' => false], 401);
        }

        Cache::put('last_scanned_uid', $request->uid, now()->addMinutes(5));

        return response()->json([
            'success' => true,
            'uid' => $request->uid
        ]);
    }

    /**
     * LOGIC UTAMA (DIPAKAI KEDUA JALUR)
     */
    private function processUid(string $uid, bool $fromUI)
    {
        $user = User::where('uid', $uid)->with('employee')->first();

        if (!$user || !$user->employee) {
            Log::warning('UID NOT FOUND', ['uid' => $uid]);

            return $fromUI
                ? back()->with('error', 'UID tidak ditemukan')
                : response()->json([
                    'success' => false,
                    'message' => 'UID tidak ditemukan'
                ], 404);
        }

        Attendance::updateOrCreate(
            [
                'employee_id' => $user->employee->id,
                'date' => now()->toDateString(),
            ],
            [
                'company_id' => $user->employee->company_id,
                'status' => 'hadir',
            ]
        );

        Log::info('ATTENDANCE SUCCESS', [
            'uid' => $uid,
            'employee' => $user->employee->name
        ]);

        return $fromUI
            ? back()->with('success', 'Absensi berhasil dicatat')
            : response()->json([
                'success' => true,
                'name' => $user->employee->name,
                'date' => now()->toDateString()
            ]);
    }
}
