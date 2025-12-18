@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-semibold mb-1">
        Absensi – {{ $company->name }}
    </h1>

    <p class="text-sm text-gray-600 mb-6">
        Pengaturan absensi hari ini ({{ now()->format('d M Y') }})
    </p>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Status Hari Ini</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @foreach($employees as $emp)
                @php
                    $attendance = $emp->attendances->first();
                @endphp

                <tr class="border-t">
                    <td class="p-3">
                        {{ $emp->name }}
                    </td>

                    <td class="p-3">
                        <span class="
                            px-2 py-1 rounded text-xs
                            @if($attendance->status === 'hadir') bg-green-100 text-green-700
                            @elseif($attendance->status === 'izin') bg-yellow-100 text-yellow-700
                            @else bg-red-100 text-red-700
                            @endif
                        ">
                            {{ ucfirst($attendance->status) }}
                        </span>
                    </td>

                    <td class="p-3">
                        <form method="POST"
                              action="{{ route('admin.attendances.update', $attendance) }}">
                            @csrf
                            @method('PATCH')

                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="border rounded px-2 py-1 text-sm">
                                <option value="hadir" @selected($attendance->status === 'hadir')>
                                    Hadir
                                </option>
                                <option value="izin" @selected($attendance->status === 'izin')>
                                    Izin
                                </option>
                                <option value="absen" @selected($attendance->status === 'absen')>
                                    Absen
                                </option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
