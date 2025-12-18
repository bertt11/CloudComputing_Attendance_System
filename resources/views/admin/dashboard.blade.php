@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    {{-- HEADER --}}
    <h1 class="text-3xl font-semibold text-white">
        Dashboard Admin
    </h1>
    <p class="mt-1 text-sm text-gray-400">
        {{ auth()->user()->name }} • {{ auth()->user()->email }}
    </p>

    {{-- GRID --}}
    <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- IZIN (PRIORITAS) --}}
        <a href="{{ route('admin.permissions.index') }}"
           class="group lg:col-span-2 p-8 bg-yellow-500/90 rounded-xl shadow-lg
                  transition transform hover:scale-[1.02] hover:bg-yellow-500">

            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-yellow-100 uppercase tracking-wide">
                        Izin Menunggu Persetujuan
                    </div>
                    <div class="mt-3 text-4xl font-bold text-gray-900">
                        {{ $izinCount }}
                    </div>
                </div>

                <div class="text-sm text-yellow-100">
                    Kelola izin →
                </div>
            </div>
            {{-- ABSENSI VIA UID --}}
            <a href="{{ route('admin.absence.uid') }}"
            class="p-6 bg-indigo-500/90 rounded-xl shadow
                    transition transform hover:scale-105 hover:bg-indigo-500">

                <div class="text-sm text-indigo-100">
                    Absensi Manual (UID)
                </div>

                <div class="mt-2 text-2xl font-bold text-white">
                    Scan / Input UID
                </div>

                <p class="mt-3 text-xs text-indigo-100">
                    Absen cepat menggunakan UID karyawan →
                </p>
            </a>


            <p class="mt-4 text-sm text-yellow-100">
                Izin dari karyawan yang membutuhkan persetujuan admin
            </p>
        </a>

        {{-- TOTAL KARYAWAN --}}
        <div class="p-6 bg-gray-800 rounded-xl shadow">
            <div class="text-sm text-gray-400">
                Total Karyawan
            </div>
            <div class="mt-2 text-3xl font-bold text-white">
                {{ $totalEmployees }}
            </div>

            <p class="mt-3 text-xs text-gray-500">
                Seluruh karyawan dalam perusahaan
            </p>
        </div>

        {{-- ABSEN --}}
        <a href="{{ route('admin.attendances.index') }}"
           class="p-6 bg-red-500/90 rounded-xl shadow
                  transition transform hover:scale-105 hover:bg-red-500">

            <div class="text-sm text-red-100">
                Karyawan Absen Hari Ini
            </div>
            <div class="mt-2 text-3xl font-bold text-white">
                {{ $absenCount }}
            </div>

            <p class="mt-3 text-xs text-red-100">
                Cek & kelola absensi →
            </p>
        </a>

    </div>

    <!-- {{-- QUICK NAV --}}
    <div class="mt-10 flex flex-wrap gap-4">
        <a href="{{ route('admin.permissions.index') }}"
           class="px-5 py-2.5 rounded-lg bg-yellow-600 hover:bg-yellow-700
                  text-gray-900 font-medium text-sm transition shadow">
            Kelola Izin
        </a>

        <a href="{{ route('admin.attendances.index') }}"
           class="px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700
                  text-white font-medium text-sm transition shadow">
            Kelola Absensi
        </a>
    </div> -->

</div>
@endsection
