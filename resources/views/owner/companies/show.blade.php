@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-semibold">{{ $company->name }}</h1>
            <p class="text-sm text-gray-600">Daftar karyawan perusahaan</p>
        </div>

        <a href="{{ route('owner.employees.create', $company) }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded text-sm">
            + Tambah Karyawan
        </a>
    </div>

    {{-- TABEL KARYAWAN --}}
    <div class="bg-white shadow rounded-lg p-4">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $emp)
                <tr class="border-t">
                    <td>{{ $emp->id }}</td>
                    <td>{{ $emp->name }}</td>
                    <td>{{ ucfirst($emp->user->role) }}</td>
                    <td>{{ ucfirst($emp->status) }}</td>
                    <td>
                        <form method="POST"
                              action="{{ route('owner.employees.role', $emp) }}">
                            @csrf
                            @method('PATCH')

                            <select name="role" onchange="this.form.submit()">
                                <option value="employee" @selected($emp->user->role==='employee')>
                                    Employee
                                </option>
                                <option value="admin" @selected($emp->user->role==='admin')>
                                    Admin
                                </option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">
                        Belum ada karyawan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
