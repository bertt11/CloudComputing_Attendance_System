@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    {{-- HEADER --}}
    <h1 class="text-3xl font-semibold text-white mb-1">
        Daftar Karyawan
    </h1>

    <p class="text-sm text-gray-300 mb-8">
        @if($status)
            Filter status:
            <span class="font-medium capitalize text-white">{{ $status }}</span>
        @else
            Menampilkan seluruh karyawan
        @endif
    </p>

    {{-- FILTER --}}
    <div class="flex flex-wrap gap-2 mb-10">
        <a href="{{ route('owner.employees.index') }}"
           class="px-4 py-1.5 rounded-full text-sm border
           {{ !$status ? 'bg-white text-gray-900' : 'border-gray-600 text-gray-300 hover:bg-gray-700' }}">
            Semua
        </a>

        <a href="{{ route('owner.employees.index', [
                'status' => 'hadir',
                'company' => request('company')
            ]) }}">
            Hadir
        </a>

        <a href="{{ route('owner.employees.index', ['status' => 'izin']) }}"
           class="px-4 py-1.5 rounded-full text-sm border
           {{ $status==='izin'
                ? 'bg-yellow-500 text-gray-900'
                : 'border-yellow-500 text-yellow-300 hover:bg-yellow-900/40' }}">
            Izin
        </a>

        <a href="{{ route('owner.employees.index', ['status' => 'absen']) }}"
           class="px-4 py-1.5 rounded-full text-sm border
           {{ $status==='absen'
                ? 'bg-red-600 text-white'
                : 'border-red-500 text-red-300 hover:bg-red-900/40' }}">
            Absen
        </a>
    </div>

    {{-- PER COMPANY --}}
    @forelse($companies as $company)

        <div class="mb-12">

            <h2 class="text-lg font-semibold text-indigo-300 mb-4">
                {{ $company->name }}
            </h2>

            <div class="bg-gray-800 rounded-xl shadow overflow-hidden">

                <table class="w-full text-sm text-gray-200">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="p-4 text-left font-medium">Nama</th>
                            <th class="p-4 text-left font-medium">Email</th>
                            <th class="p-4 text-left font-medium">Status Hari Ini</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php $hasData = false; @endphp

                    @foreach($company->employees as $emp)
                        @php
                            $attendance = $emp->attendances->first();
                            $todayStatus = $attendance->status ?? 'absen';

                            if ($status && $todayStatus !== $status) {
                                continue;
                            }

                            $hasData = true;
                        @endphp

                       <tr class="border-t border-gray-700 hover:bg-gray-700/40 transition">
                            <td class="p-4 font-medium text-white">
                                {{ $emp->name }}
                            </td>

                            <td class="p-4 text-gray-300">
                                {{ $emp->user->email ?? '-' }}
                            </td>

                            <td class="p-4 flex items-center gap-3">
                                {{-- STATUS BADGE --}}
                                <span class="
                                    inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                    @if($todayStatus==='hadir') bg-blue-500/20 text-blue-300
                                    @elseif($todayStatus==='izin') bg-yellow-500/20 text-yellow-300
                                    @else bg-red-500/20 text-red-300
                                    @endif
                                ">
                                    {{ ucfirst($todayStatus) }}
                                </span>

                                {{-- LINK BUKTI IZIN --}}
                                @if($todayStatus === 'izin' && $attendance?->proof_file)
                                    <a href="{{ $attendance->proof_file }}"
                                    target="_blank"
                                    class="text-xs text-indigo-400 hover:underline">
                                        Lihat Bukti
                                    </a>
                                @endif
                            </td>
                        </tr>

                    @endforeach

                    @if(!$hasData)
                        <tr>
                            <td colspan="3"
                                class="p-6 text-center text-gray-400 italic">
                                Tidak ada karyawan sesuai filter
                            </td>
                        </tr>
                    @endif
                    </tbody>

                </table>
            </div>
        </div>

    @empty
        <p class="text-gray-400">
            Belum ada perusahaan.
        </p>
    @endforelse

</div>
@endsection
