@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    {{-- HEADER --}}
    <h1 class="text-3xl font-semibold text-white">
        Dashboard Owner
    </h1>
    <p class="mt-1 text-sm text-gray-300">
        Selamat datang, {{ auth()->user()->name }}
    </p>

    {{-- GRID --}}
    <div class="mt-10 grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- PERUSAHAAN (FULL ROW & LEBIH TINGGI) --}}
        <a href="{{ route('owner.companies.index') }}"
           class="group lg:col-span-4 p-8 bg-indigo-600/90 rounded-xl shadow-lg
                  transition transform hover:scale-[1.02] hover:bg-indigo-600">

            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-indigo-200 uppercase tracking-wide">
                        Perusahaan
                    </div>
                    <div class="mt-3 text-4xl font-bold text-white">
                        {{ $companyCount }}
                    </div>
                </div>

                <div class="text-indigo-200 text-sm">
                    Kelola seluruh perusahaan →
                </div>
            </div>
        </a>

        {{-- TOTAL KARYAWAN --}}
        <a href="{{ route('owner.employees.index') }}"
           class="group p-6 bg-emerald-500/90 rounded-xl shadow
                  transition transform hover:scale-105 hover:bg-emerald-500">

            <div class="text-sm text-emerald-100">
                Total Karyawan
            </div>
            <div class="mt-2 text-3xl font-bold text-white">
                {{ $employeeCount }}
            </div>
        </a>

        {{-- HADIR --}}
        <a href="{{ route('owner.employees.index', ['status' => 'hadir']) }}"
           class="group p-6 bg-blue-500/90 rounded-xl shadow
                  transition transform hover:scale-105 hover:bg-blue-500">

            <div class="text-sm text-blue-100">
                Hadir Hari Ini
            </div>
            <div class="mt-2 text-3xl font-bold text-white">
                {{ $hadirToday }}
            </div>
        </a>

        {{-- IZIN --}}
        <a href="{{ route('owner.employees.index', ['status' => 'izin']) }}"
           class="group p-6 bg-yellow-500/90 rounded-xl shadow
                  transition transform hover:scale-105 hover:bg-yellow-500">

            <div class="text-sm text-yellow-100">
                Izin Hari Ini
            </div>
            <div class="mt-2 text-3xl font-bold text-white">
                {{ $izinToday }}
            </div>
        </a>

        {{-- ABSEN --}}
        <a href="{{ route('owner.employees.index', ['status' => 'absen']) }}"
           class="group p-6 bg-red-500/90 rounded-xl shadow
                  transition transform hover:scale-105 hover:bg-red-500">

            <div class="text-sm text-red-100">
                Absen Hari Ini
            </div>
            <div class="mt-2 text-3xl font-bold text-white">
                {{ $absenToday }}
            </div>
        </a>

    </div>

</div>
@endsection
