{{-- resources/views/layouts/app.blade.php --}}
@props([])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles (Tailwind/Breeze) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

    {{-- Navbar / top menu --}}
    @includeIf('layouts.partials.nav')

    <div class="min-h-screen">
        <main class="py-6 px-4 max-w-7xl mx-auto">
            {{-- SUPPORT BOTH: Blade component slot OR classic section('content') --}}
            @if (isset($slot) && trim($slot) !== '')
                {{-- Used as a component: <x-app-layout> ... </x-app-layout> --}}
                {{ $slot }}
            @else
                {{-- Used as classic blade: @section('content') ... @endsection --}}
                @yield('content')
            @endif
        </main>
    </div>

    {{-- Footer --}}
    @includeIf('layouts.partials.footer') {{-- optional --}}
    @stack('scripts')
</body>
</html>
