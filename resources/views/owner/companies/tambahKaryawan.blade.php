@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-semibold mb-4">
        Tambah Karyawan – {{ $company->name }}
    </h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST"
              action="{{ route('owner.employees.store', $company) }}">
            @csrf

            <div class="mb-3">
                <label class="text-sm">Nama</label>
                <input name="name" required class="border p-2 w-full">
            </div>

            <div class="mb-3">
                <label class="text-sm">Email</label>
                <input name="email" type="email" required class="border p-2 w-full">
            </div>

            <div class="mb-3">
                <label class="text-sm">Password</label>
                <input name="password" type="password" required class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label class="text-sm">Role</label>
                <select name="role" class="border p-2 w-full">
                    <option value="employee">Employee</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('owner.companies.show', $company) }}"
                   class="text-sm text-gray-600">
                    ← Kembali
                </a>

                <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
