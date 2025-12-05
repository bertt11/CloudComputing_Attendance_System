@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
  <div class="flex justify-between items-center">
    <h1 class="text-xl  text-white font-semibold">Daftar Perusahaan</h1>
    <a href="{{ route('owner.companies.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Tambah Perusahaan</a>
  </div>

  <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach($companies as $c)
      <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="flex justify-between items-start">
          <div>
            <h3 class="font-medium text-white text-lg">{{ $c->name }}</h3>
            <p class="text-sm text-gray-500 mt-1">ID: {{ $c->id }}</p>
          </div>
          <div class="text-sm">
           <a href="{{ route('owner.companies.show', $c->id) }}" class="px-2 py-1 bg-indigo-600 text-white rounded-md">Detail</a>
 </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
