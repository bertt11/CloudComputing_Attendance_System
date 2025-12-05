@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
  <div class="bg-white dark:bg-gray-300 p-6 rounded-lg shadow">
    <h1 class="text-xl font-semibold">Tambah Perusahaan</h1>

    <form action="{{ route('owner.companies.store') }}" method="POST" class="mt-4 space-y-4">
      @csrf
      <div>
        <label class="text-sm">Nama Perusahaan</label>
        <input name="name" class="w-full mt-1 px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-100" required>
      </div>
      <div>
        <label class="text-sm">Password Perusahaan</label>
        <input name="password" type="password" class="w-full mt-1 px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-100" required>
        <p class="text-xs text-gray-500 mt-1">Password digunakan admin untuk memilih perusahaan.</p>
      </div>
      <div class="pt-2">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
