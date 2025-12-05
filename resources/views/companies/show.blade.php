@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
  <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
      <div>
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $company->name }}</h1>
        <p class="text-sm text-gray-500">ID: {{ $company->id }}</p>
      </div>
      <div>
        <a href="{{ route('owner.companies.index') }}" class="px-3 py-2 bg-gray-200 rounded-md">Kembali</a>
      </div>
    </div>

    <h2 class="text-lg text-white font-medium mb-3">Daftar Karyawan & Status Absensi (Hari ini)</h2>

    <div class="overflow-x-auto bg-white dark:bg-gray-900 rounded-lg shadow">
      <table class="min-w-full text-white text-left">
        <thead class="bg-gray-50 dark:bg-gray-800">
          <tr>
            <th class="px-4 py-3">NO</th>
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">UID</th>
            <th class="px-4 py-3">Jabatan</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Waktu</th>
            <th class="px-4 py-3">Berkas Ijin</th>
          </tr>
        </thead>
        <tbody>
          @forelse($employees as $emp)
            @php
              $att = $emp->attendances->first(); // attendances filtered by today in controller
              $status = $att?->status ?? 'bolos';
            @endphp
            <tr class="border-t">
              <td class="px-4 py-3">{{ $loop->iteration }}</td>
              <td class="px-4 py-3">{{ $emp->name }}</td>
              <td class="px-4 py-3 font-mono text-sm">{{ $emp->uid }}</td>
              <td class="px-4 py-3">{{ $emp->position }}</td>
              <td class="px-4 py-3">
                <span class="px-2 py-1 rounded text-sm {{ $status == 'hadir' ? 'bg-green-100 text-green-800' : ($status == 'ijin' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                  {{ ucfirst($status) }}
                </span>
              </td>
              <td class="px-4 py-3">{{ $att?->time ?? '-' }}</td>
              <td class="px-4 py-3">
                @if($att?->file_path)
                  <a href="{{ Storage::url($att->file_path) }}" class="text-indigo-600">Lihat</a>
                @else
                  -
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td class="px-4 py-6 text-center" colspan="7">Belum ada karyawan</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- <div class="mt-4">
      <a href="{{ route('admin.attendances.index', ['company' => $company->id]) }}" class="px-3 py-2 bg-indigo-600 text-white rounded-md">Lihat Semua Absensi</a>
    </div> -->
  </div>
</div>
@endsection
