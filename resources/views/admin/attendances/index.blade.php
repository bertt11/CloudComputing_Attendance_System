@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    {{-- HEADER --}}
    <h1 class="text-3xl font-semibold text-white mb-1">
        Absensi Karyawan
    </h1>

    <p class="text-sm text-gray-300 mb-8">
        {{ $company->name }} · {{ now()->format('d M Y') }}
    </p>

    <div class="bg-gray-800 rounded-xl shadow overflow-x-auto">

        <table class="w-full text-sm text-gray-200">
            <thead class="bg-gray-700 text-gray-300">
                <tr>
                    <th class="p-4 text-left font-medium">Nama</th>
                    <th class="p-4 text-left font-medium">Email</th>
                    <th class="p-4 text-left font-medium">Status Hari Ini</th>
                </tr>
            </thead>

            <tbody>
            @foreach($employees as $emp)
                @php
                    $attendance = $emp->attendances->first();
                    $status = $attendance->status ?? 'absen';
                @endphp

                <tr class="border-t border-gray-700 hover:bg-gray-700/40 transition">

                    {{-- NAMA --}}
                    <td class="p-4 font-medium text-white">
                        {{ $emp->name }}
                    </td>

                    {{-- EMAIL --}}
                    <td class="p-4 text-gray-300">
                        {{ $emp->user->email ?? '-' }}
                    </td>

                    {{-- STATUS --}}
                    <td class="p-4">
                        @if($status === 'pending_izin')
                            <a href="{{ route('admin.permissions.index') }}"
                               class="inline-flex items-center gap-2
                                      px-3 py-1.5 rounded-full text-xs font-semibold
                                      bg-yellow-500/20 text-yellow-300
                                      hover:bg-yellow-500/30 transition">
                                Pending Izin
                                <span class="text-[10px] opacity-80">(klik)</span>
                            </a>

                        @elseif($status === 'izin')
                            <span class="inline-flex px-3 py-1.5 rounded-full
                                         text-xs font-semibold
                                         bg-indigo-500/20 text-indigo-300">
                                Izin
                            </span>

                        @elseif($status === 'hadir')
                            <span class="inline-flex px-3 py-1.5 rounded-full
                                         text-xs font-semibold
                                         bg-blue-500/20 text-blue-300">
                                Hadir
                            </span>

                        @else
                            <span class="inline-flex px-3 py-1.5 rounded-full
                                         text-xs font-semibold
                                         bg-red-500/20 text-red-300">
                                Absen
                            </span>
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>

    </div>

</div>
@endsection
