@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
  <div class="bg-white text-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h1 class="text-xl font-semibold">Tambah Karyawan - {{ $company->name }}</h1>
    <form action="{{ route('admin.employees.store', $company->id) }}" method="POST" class="mt-4 space-y-4">
      @csrf
      <div>
        <label class="text-sm">UID</label>
        <input name="name" class="w-full mt-1 px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-900" required>
      </div>
      <div>
        <label class="text-sm">Nama</label>
        <input name="name" class="w-full mt-1 px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-900" required>
      </div>
      <div>
        <label class="text-sm">UID</label>
        <input name="uid" class="w-full mt-1 px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-900" required>
      </div>
      <div>
        <label class="text-sm">Jabatan</label>
        <input name="position" class="w-full mt-1 px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-900">
      </div>
      <div>
        <button class="px-4 py-2 bg-green-600 text-white rounded-md">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
