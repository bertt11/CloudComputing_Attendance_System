@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
  <h1 class="text-xl text-white font-semibold">Pilih Perusahaan</h1>
  <div class="mt-4 space-y-4">
    @foreach($companies as $c)
      <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow flex justify-between items-center">
        <div>
          <div class="font-medium text-white">{{ $c->name }}</div>
          <div class="text-sm text-gray-500">ID: {{ $c->id }}</div>
        </div>
        <form action="{{ route('admin.company.enter', $c->id) }}" method="POST" class="flex gap-2 items-center">
          @csrf
          <input type="password" name="password" placeholder="Password perusahaan" class="px-2 py-1 border rounded-md bg-gray-50 dark:bg-gray-900" required>
          <button class="px-3 py-1 bg-indigo-600 text-white rounded-md">Enter</button>
        </form>
      </div>
    @endforeach
  </div>
</div>
@endsection
