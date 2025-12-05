<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller {
    // Admin view list employees for a company
    public function index($companyId){
        $company = Company::findOrFail($companyId);
        $employees = $company->employees()->get();
        return view('employees.index', compact('company','employees'));
    }

    public function create($companyId){
        $company = Company::findOrFail($companyId);
        return view('employees.create', compact('company'));
    }

    public function store(Request $req, $companyId){
        $req->validate(['name'=>'required','uid'=>'required|unique:employees,uid']);
        $employee = Employee::create([
            'company_id'=>$companyId,
            'name'=>$req->name,
            'uid'=>$req->uid,
            'position'=>$req->position
        ]);
        return redirect()->route('admin.company.employees', $companyId)->with('success','Karyawan ditambahkan');
    }

    // employee dashboard (for logged in employee)
    public function dashboard(){
        $user = Auth::user();
        $company = $user->company;
        return view('employees.dashboard', compact('company','user'));
    }

    public function showCompany($companyId){
        $company = Company::findOrFail($companyId);
        return view('employees.company', compact('company'));
    }
}
