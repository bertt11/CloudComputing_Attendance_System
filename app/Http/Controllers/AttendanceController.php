<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller {
    // Admin scanning UID
    public function scan(Request $req, $companyId){
        $req->validate(['uid'=>'required']);
        $employee = Employee::where('company_id', $companyId)->where('uid', $req->uid)->first();
        if(!$employee){
            return response()->json(['status'=>'error','message'=>'Karyawan tidak tersedia'],404);
        }
        // prevent double check-in:
        $exists = Attendance::where('employee_id',$employee->id)
            ->whereDate('time', now()->toDateString())
            ->where('status','hadir')
            ->exists();
        if($exists){
            return response()->json(['status'=>'error','message'=>'Sudah hadir hari ini'],409);
        }
        $att = Attendance::create([
            'company_id'=>$companyId,
            'employee_id'=>$employee->id,
            'status'=>'hadir',
            'time'=>now(),
            'uid'=>$req->uid
        ]);
        return response()->json(['status'=>'ok','attendance'=>$att],201);
    }

    // Employee request leave (upload file)
    public function requestLeave(Request $req, $companyId){
        $req->validate(['reason'=>'required','file'=>'required|mimes:jpg,png,pdf|max:5120']);
        $user = Auth::user();
        $employee = Employee::find($user->employee_id);
        if(!$employee) return back()->withErrors(['error'=>'Employee profile tidak ditemukan']);

        $path = $req->file('file')->store('leave_docs','public'); // change to 's3' in AWS
        $att = Attendance::create([
            'company_id'=>$companyId,
            'employee_id'=>$employee->id,
            'status'=>'ijin',
            'time'=>now(),
            'note'=>$req->reason,
            'file_path'=>$path
        ]);
        return back()->with('success','Permohonan ijin terkirim');
    }

    // list attendances (owner/admin view)
    public function index($companyId){
        $company = Company::findOrFail($companyId);
        $attendances = $company->attendances()->with('employee')->latest()->paginate(30);
        return view('attendances.index', compact('company','attendances'));
    }
}
