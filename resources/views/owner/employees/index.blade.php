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
            ]) }}  "
            class="px-4 py-1.5 rounded-full text-sm border
           {{ $status==='hadir'
                ? 'bg-blue-500 text-gray-900'
                : 'border-blue-500 text-blue-300 hover:bg-blue-900/40' }}">

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

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-indigo-300">
                    {{ $company->name }}
                </h2>

                <a href="{{ route('owner.employees.create', $company) }}"
                class="inline-flex items-center gap-2 px-4 py-1.5
                        bg-indigo-600 hover:bg-indigo-700
                        text-sm text-white rounded-lg shadow transition">
                    + Tambah Karyawan
                </a>
            </div>


            <div class="bg-gray-800 rounded-xl shadow overflow-hidden">

                <table class="w-full text-sm text-gray-200">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="p-4 text-left font-medium">Nama</th>
                            <th class="p-4 text-left font-medium">Email</th>
                            <th class="p-4 text-left font-medium">Status Hari Ini</th>
                            <th class="p-4 text-left font-medium">Role</th>
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
                            {{-- NAMA --}}
                            <td class="p-4 font-medium">
                                <a href="{{ route('owner.employees.edit', $emp) }}"
                                class="text-white hover:text-indigo-400 hover:underline transition">
                                    {{ $emp->name }}
                                </a>
                            </td>


                            {{-- EMAIL --}}
                            <td class="p-4 text-gray-300">
                                {{ $emp->user->email ?? '-' }}
                            </td>

                            {{-- STATUS --}}
                            <td class="p-4 flex items-center gap-3">
                                <span class="
                                    inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                    @if($todayStatus==='hadir') bg-blue-500/20 text-blue-300
                                    @elseif($todayStatus==='izin') bg-yellow-500/20 text-yellow-300
                                    @else bg-red-500/20 text-red-300
                                    @endif
                                ">
                                    {{ ucfirst($todayStatus) }}
                                </span>

                                @if($todayStatus === 'izin' && $attendance?->proof_file)
                                    <a href="{{ $attendance->proof_file }}"
                                    target="_blank"
                                    class="text-xs text-indigo-400 hover:underline">
                                        Lihat Bukti
                                    </a>
                                @endif
                            </td>

                            {{-- ROLE ACTION --}}
                            <td class="p-4">
                                @if($emp->user)
                                <form method="POST"
                                    action="{{ route('owner.employees.role', $emp) }}"
                                    onsubmit="return confirm('Yakin ingin mengubah role karyawan ini?')">
                                    @csrf
                                    @method('PATCH')

                                    <select name="role"
                                            class="bg-gray-900 border border-gray-600 text-sm rounded px-2 py-1
                                                text-gray-200 focus:ring-indigo-500"
                                            onchange="this.form.submit()">

                                        <option value="employee"
                                            @selected($emp->user->role === 'employee')>
                                            Employee
                                        </option>

                                        <option value="admin"
                                            @selected($emp->user->role === 'admin')>
                                            Admin
                                        </option>

                                    </select>
                                </form>
                                @else
                                    <span class="text-xs text-gray-500 italic">No user</span>
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
