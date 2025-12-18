<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Form tambah karyawan
     */
    public function create(Company $company)
    {
        if ($company->owner_id !== Auth::id()) {
            abort(403);
        }

        return view('owner.companies.tambahKaryawan', compact('company'));
    }

    /**
     * Simpan karyawan + user login
     */
    public function store(Request $request, Company $company)
    {
        if ($company->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'uid'      => 'nullable|string|max:100',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,employee',
        ]);


        // USER (untuk login)
        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'uid'        => $request->uid, 
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'company_id' => $company->id,
        ]);


        // EMPLOYEE (data kepegawaian)
        Employee::create([
            'company_id' => $company->id,
            'user_id' => $user->id,
            'name' => $request->name,
            'status' => 'absen',
        ]);

        return redirect()
            ->route('owner.employees.index', $company)
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

        public function edit(Employee $employee)
    {
        if ($employee->company->owner_id !== Auth::id()) {
            abort(403);
        }

        return view('owner.employees.editKaryawan', compact('employee'));
    }

        public function update(Request $request, Employee $employee)
    {
        if ($employee->company->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->user_id,
            'uid'   => 'nullable|string|max:100',
        ]);

        // update user
        $employee->user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'uid'   => $request->uid,
        ]);

        // update employee
        $employee->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('owner.employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }



    /**
     * Ubah role admin / employee
     */
    public function updateRole(Request $request, Employee $employee)
    {
        if ($employee->company->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'role' => 'required|in:admin,employee',
        ]);

        $employee->user->update([
            'role' => $request->role
        ]);

        return back()->with('success', 'Role berhasil diubah');
    }
}
