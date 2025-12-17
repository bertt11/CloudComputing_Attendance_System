@extends('layouts.app')

@section('content')
@php
    use App\Models\Company;
    use App\Models\Employee;
    use Illuminate\Support\Facades\Auth;

    $ownerId = Auth::id();

    // total perusahaan milik owner
    $totalCompanies = Company::where('owner_id', $ownerId)->count();

    // total karyawan dari semua perusahaan milik owner
    $totalEmployees = Employee::whereIn(
        'company_id',
        Company::where('owner_id', $ownerId)->pluck('id')
    )->count();

    // absensi belum dipakai
    $totalAttendancesToday = 0;
@endphp

<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

        {{-- Header --}}
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
            Dashboard Owner
        </h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            Selamat datang, <span class="font-medium">{{ Auth::user()->name }}</span>
        </p>

        <div class="my-6 border-t border-gray-200 dark:border-gray-700"></div>

        {{-- BELUM PUNYA PERUSAHAAN --}}
        @if($totalCompanies === 0)

            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200">
                    Anda belum memiliki perusahaan
                </h2>
                <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                    Untuk mulai menggunakan sistem, silakan buat perusahaan terlebih dahulu.
                </p>

                <div class="mt-4">
                    <a href="{{ route('owner.companies.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium">
                        + Buat Perusahaan
                    </a>
                </div>
            </div>

        @else

        {{-- SUDAH PUNYA PERUSAHAAN --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <div class="p-4 bg-indigo-50 rounded-lg">
            <div class="text-sm">Perusahaan</div>
            <div class="text-2xl font-bold">{{ $companyCount }}</div>
        </div>

        <div class="p-4 bg-green-50 rounded-lg">
            <div class="text-sm">Karyawan</div>
            <div class="text-2xl font-bold">{{ $employeeCount }}</div>
        </div>

        <div class="p-4 bg-yellow-50 rounded-lg">
            <div class="text-sm">Absensi Hari Ini</div>
            <div class="text-2xl font-bold">{{ $todayAttendance }}</div>
        </div>

    </div>


        <div class="mt-6">
            <a href="{{ route('owner.companies.index') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium">
                Kelola Perusahaan
            </a>
        </div>

        @endif
    </div>
</div>
@endsection
