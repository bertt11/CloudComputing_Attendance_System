<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::info('UID FROM IOT', $request->all());

        // OPTIONAL: API KEY CHECK (SANGAT DISARANKAN)
        if ($request->header('x-api-key') !== config('services.iot.api_key')) {
            Log::warning('INVALID IOT API KEY');
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        if (!$request->uid) {
            return response()->json([
                'success' => false,
                'message' => 'UID kosong'
            ], 400);
        }

        return $this->processUid($request->uid, false);
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
