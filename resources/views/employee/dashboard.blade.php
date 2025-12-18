@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    {{-- HEADER --}}
    <h1 class="text-3xl font-semibold text-white">
        Dashboard Karyawan
    </h1>

    <p class="mt-1 text-sm text-gray-300 mb-10">
        {{ $employee->name }} — {{ $employee->company->name }}
    </p>

    {{-- STATUS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">

        {{-- STATUS HARI INI --}}
        <div class="p-6 rounded-xl shadow bg-gray-800">

            <div class="text-sm text-gray-400 uppercase tracking-wide">
                Status Hari Ini
            </div>

            <div class="mt-4">
                @php
                    $status = $todayAttendance->status ?? null;
                @endphp

                <span class="
                    inline-flex items-center px-4 py-2 rounded-full
                    text-sm font-semibold
                    @if($status === 'hadir')
                        bg-blue-600 text-white
                    @elseif($status === 'izin')
                        bg-yellow-500 text-gray-900
                    @elseif($status === 'absen')
                        bg-red-600 text-white
                    @else
                        bg-gray-600 text-white
                    @endif
                ">
                    {{ $status ? ucfirst($status) : 'Belum Absen' }}
                </span>
            </div>

        </div>

        {{-- TANGGAL --}}
        <div class="p-6 rounded-xl shadow bg-gray-800">

            <div class="text-sm text-gray-400 uppercase tracking-wide">
                Tanggal
            </div>

            <div class="mt-4 text-2xl font-bold text-white">
                {{ now()->format('d M Y') }}
            </div>

        </div>
    </div>

    {{-- AKSI --}}
    <div class="flex items-center gap-4">

        <a href="{{ route('employee.permission.create') }}"
           class="inline-flex items-center gap-2
                  px-5 py-2.5 rounded-lg
                  bg-indigo-600 hover:bg-indigo-700
                  text-white text-sm font-medium
                  transition shadow">

            Ajukan Izin
        </a>

        @if($todayAttendance && $todayAttendance->proof)
            <span class="text-sm text-green-400">
                ✔ Bukti izin sudah dikirim
            </span>
        @endif

    </div>

</div>
@endsection
