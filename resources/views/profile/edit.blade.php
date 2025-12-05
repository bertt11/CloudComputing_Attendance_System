@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
  <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h1 class="text-xl font-semibold">Profil Saya</h1>
    <p class="text-sm text-gray-500 mt-2">Ubah informasi dasar akun Anda.</p>

    <form action="#" method="POST" class="mt-4 space-y-4">
      @csrf
      <div>
        <label class="text-sm">Nama</label>
        <input value="{{ Auth::user()->name }}" class="w-full mt-1 px-3 py-2 border rounded-md">
      </div>
      <div>
        <label class="text-sm">Email</label>
        <input value="{{ Auth::user()->email }}" class="w-full mt-1 px-3 py-2 border rounded-md" disabled>
      </div>
      <div>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
