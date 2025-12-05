@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
  <div class="flex justify-between items-center">
    <h1 class="text-xl text-white font-semibold">Karyawan - {{ $company->name }}</h1>
    <a href="{{ route('admin.employees.create', $company->id) }}" class="px-3 py-2 bg-indigo-600 text-white rounded-md">Tambah Karyawan</a>
    
  </div>

  <div class="mt-4 bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <table class="min-w-full text-left">
      <thead class="bg-gray-50 text-white dark:bg-gray-900">
        <tr>
          <th class="px-4 py-2">No</th>
          <th class="px-4 py-2">Nama</th>
          <th class="px-4 py-2">UID</th>
          <th class="px-4 py-2">Jabatan</th>
          <th class="px-4 py-2">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($employees as $emp)
        <tr class="border-t text-white ">
          <td class="px-4 py-3">{{ $loop->iteration }}</td>
          <td class="px-4 py-3">{{ $emp->name }}</td>
          <td class="px-4 py-3 font-mono text-sm">{{ $emp->uid }}</td>
          <td class="px-4 py-3">{{ $emp->position }}</td>
          
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <br>
  <a href="{{ route('admin.employees.create', $company->id) }}" class="px-3 py-2 bg-green-600 text-white rounded-md">Absensi</a>
</div>
@endsection
