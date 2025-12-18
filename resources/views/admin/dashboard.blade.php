@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">
        Dashboard Admin
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

        {{-- Total Karyawan --}}
        <div class="bg-white shadow rounded-lg p-6">
            <div class="text-sm text-gray-500">
                Total Karyawan
            </div>
            <div class="mt-2 text-3xl font-bold text-gray-800">
                {{ $totalEmployees }}
            </div>
        </div>

        {{-- Karyawan Izin --}}
        <a href="{{ route('admin.permissions.index') }}"
           class="bg-yellow-50 hover:bg-yellow-100 shadow rounded-lg p-6 transition">
            <div class="text-sm text-yellow-700">
                Karyawan Izin (Pending)
            </div>
            <div class="mt-2 text-3xl font-bold text-yellow-800">
                {{ $izinCount }}
            </div>
            <p class="text-xs text-yellow-600 mt-2">
                Klik untuk cek persetujuan
            </p>
        </a>

        {{-- Karyawan Absen --}}
        <a href="{{ route('admin.attendances.index') }}"
           class="bg-red-50 hover:bg-red-100 shadow rounded-lg p-6 transition">
            <div class="text-sm text-red-700">
                Karyawan Absen Hari Ini
            </div>
            <div class="mt-2 text-3xl font-bold text-red-800">
                {{ $absenCount }}
            </div>
            <p class="text-xs text-red-600 mt-2">
                Klik untuk lihat absensi
            </p>
        </a>

    </div>

</div>
@endsection
