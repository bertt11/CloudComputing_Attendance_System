@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-semibold mb-1">
        Absensi – {{ $company->name }}
    </h1>
    <p class="text-sm text-gray-600 mb-6">
        Pengaturan absensi hari ini ({{ now()->format('d M Y') }})
    </p>

    <div class="bg-white shadow rounded-lg p-4">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th>Nama</th>
                    <th>Status Hari Ini</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($employees as $emp)
                @php
                    $attendance = $emp->attendances->first()
                        ?? \App\Models\Attendance::create([
                            'company_id' => $company->id,
                            'employee_id' => $emp->id,
                            'date' => today(),
                            'status' => 'absen',
                        ]);
                @endphp

                <tr class="border-t">
                    <td>{{ $emp->name }}</td>
                    <td>{{ ucfirst($attendance->status) }}</td>
                    <td>
                        <form method="POST"
                              action="{{ route('admin.attendances.update', $attendance) }}">
                            @csrf
                            @method('PATCH')

                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="border rounded px-2 py-1">
                                <option value="hadir" @selected($attendance->status==='hadir')>Hadir</option>
                                <option value="izin" @selected($attendance->status==='izin')>Izin</option>
                                <option value="absen" @selected($attendance->status==='absen')>Absen</option>
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
