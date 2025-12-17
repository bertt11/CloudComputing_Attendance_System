@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    <div class="bg-white shadow rounded-lg p-6">

        <h1 class="text-2xl font-semibold mb-1">
            Dashboard Karyawan
        </h1>

        <p class="text-sm text-gray-600 mb-6">
            {{ $employee->name }} — {{ $employee->company->name }}
        </p>

        {{-- STATUS ABSENSI --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">

            <div class="p-4 bg-indigo-50 rounded-lg">
                <div class="text-sm text-indigo-700">Status Hari Ini</div>
                <div class="mt-2 text-xl font-bold text-indigo-900">
                    {{ $todayAttendance? ucfirst($todayAttendance->status) : 'Belum Absen' }}
                </div>
            </div>

            <div class="p-4 bg-green-50 rounded-lg">
                <div class="text-sm text-green-700">Tanggal</div>
                <div class="mt-2 text-xl font-bold text-green-900">
                    {{ now()->format('d M Y') }}
                </div>
            </div>

        </div>

        {{-- AKSI --}}
        <div class="flex gap-4">
            <a href="{{ route('employee.permission.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded text-sm">
                Ajukan Izin
            </a>

            @if($todayAttendance && $todayAttendance->proof)
                <span class="text-sm text-gray-600 self-center">
                    Bukti izin sudah dikirim
                </span>
            @endif
        </div>

    </div>

</div>
@endsection
