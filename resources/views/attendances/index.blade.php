@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
  <h1 class="text-xl text-white font-semibold">Daftar Absensi - {{ $company->name }}</h1>

  <div class="mt-4 bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <table class="min-w-full text-left">
      <thead class="bg-gray-50 text-white dark:bg-gray-900">
        <tr>
          <th class="px-4 py-2">No</th>
          <th class="px-4 py-2">Nama</th>
          <th class="px-4 py-2">Status</th>
          <th class="px-4 py-2">Waktu</th>
          <th class="px-4 py-2">Berkas</th>
        </tr>
      </thead>
      <tbody>
        @foreach($attendances as $att)
        <tr class="border-t">
          <td class="px-4 py-3">{{ $loop->iteration }}</td>
          <td class="px-4 py-3">{{ $att->employee?->name ?? 'Unknown' }}</td>
          <td class="px-4 py-3">
            <span class="px-2 py-1 rounded text-sm {{ $att->status == 'hadir' ? 'bg-green-100 text-green-800' : ($att->status == 'ijin' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
              {{ ucfirst($att->status) }}
            </span>
          </td>
          <td class="px-4 py-3">{{ $att->time }}</td>
          <td class="px-4 py-3">
            @if($att->file_path)
              <a href="{{ Storage::url($att->file_path) }}" class="text-indigo-600">Lihat</a>
            @else
              -
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="p-4">
      {{ $attendances->links() }}
    </div>
  </div>
</div>
@endsection
