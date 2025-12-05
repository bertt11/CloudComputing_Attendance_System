<?php
namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller {
    // Owner: index, create, store
    public function index(){
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create(){
        return view('companies.create');
    }

    public function store(Request $req){
        $req->validate(['name'=>'required','password'=>'required|min:4']);
        $company = Company::create([
            'name'=>$req->name,
            'password'=>Hash::make($req->password)
        ]);
        return redirect()->route('owner.companies.index')->with('success','Perusahaan dibuat');
    }

    // Admin/company selection (show list to pick company)
    public function select(){
        $companies = Company::all();
        return view('companies.select', compact('companies'));
    }

    public function enter(Request $req, Company $company){
        $req->validate(['password'=>'required']);
        if(!Hash::check($req->password, $company->password)){
            return back()->withErrors(['password'=>'Password perusahaan salah']);
        }
        session(['company_id' => $company->id]);
        return redirect()->route('admin.company.employees', $company->id);
    }

    /**
 * Tampilkan detail perusahaan: list karyawan + status absensi hari ini
    */
    public function show(Company $company)
    {
        // ambil employees dengan attendances hanya hari ini
        $employees = $company->employees()
            ->with(['attendances' => function($q){
                $q->whereDate('time', now());
            }])
            ->get();

        return view('companies.show', compact('company','employees'));
    }

}
