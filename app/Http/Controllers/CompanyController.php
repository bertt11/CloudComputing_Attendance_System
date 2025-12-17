<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * List perusahaan milik owner
     */
    public function index()
    {
        $companies = Company::where('owner_id', Auth::id())->get();
        return view('owner.companies.index', compact('companies'));
    }

    /**
     * Form create perusahaan
     */
    public function create()
    {
        return view('owner.companies.create');
    }

    /**
     * Simpan perusahaan
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $company = Company::create([
            'name' => $request->name,
            'address' => $request->description,
            'owner_id' => Auth::id(),
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update([
            'company_id' => $company->id
        ]);

        return redirect()
            ->route('owner.dashboard')
            ->with('success', 'Perusahaan berhasil dibuat.');
    }

    /**
     * Detail perusahaan + list karyawan
     */
    public function show(Company $company)
    {
        if ($company->owner_id !== Auth::id()) {
            abort(403);
        }

        $employees = $company->employees()->with('user')->get();

        return view('owner.companies.show', compact('company', 'employees'));
    }
}
