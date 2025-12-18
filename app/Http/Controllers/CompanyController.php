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
            'address' => 'nullable|string|max:255',
        ]);

        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'owner_id' => Auth::id(),
        ]);

        return redirect()
            ->route('owner.companies.index')
            ->with('success', 'Perusahaan berhasil dibuat');
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

        public function edit(Company $company)
    {
        return view('owner.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $company->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('owner.companies.index')
            ->with('success', 'Perusahaan berhasil diperbarui');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()
            ->route('owner.companies.index')
            ->with('success', 'Perusahaan berhasil dihapus');
    }

}
