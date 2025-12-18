<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

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

    //Simpan izin + upload bukti ke S3 
    public function store(Request $request)
    {
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'note'  => 'nullable|string|max:255',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $file = $request->file('proof');

        // nama file unik
        $filename = 'permission_' . time() . '_' . $file->getClientOriginalName();

        // URL bucket S3
        $bucketUrl = 'https://ec2-laravel-s3-role.s3.amazonaws.com/';
        $fileUrl   = $bucketUrl . $filename;

        // upload ke S3 via HTTP (tanpa IAM)
        $client = new Client([
        'verify' => false
        ]);

        $client->put($fileUrl, [
            'body' => fopen($file->getPathname(), 'r'),
            'headers' => [
                'Content-Type' => $file->getMimeType(),
            ],
        ]);


        // simpan / update absensi hari ini
        Attendance::updateOrCreate(
            [
                'employee_id' => $employee->id,
                'date'        => today(),
            ],
            [
                'company_id' => $employee->company_id,
                'status'     => 'pending_izin', // menunggu approval admin
                'note'       => $request->note,
                'proof_file'      => $fileUrl, // SIMPAN URL S3
            ]
        );

        return redirect()
            ->route('employee.dashboard')
            ->with('success', 'Izin berhasil dikirim dan menunggu persetujuan admin.');
    }
}
