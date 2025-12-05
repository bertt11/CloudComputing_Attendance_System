<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <div class="flex items-center gap-6">
        <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-gray-800 dark:text-gray-100">AttendanceSystem</a>
        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-800">Dashboard</a>
        @auth
          @if(auth()->user()->role === 'owner')
            <a href="{{ route('owner.companies.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-800">Perusahaan</a>
          @endif
          @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.companies.select') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-800">Pilih Perusahaan</a>
          @endif
          @if(auth()->user()->role === 'employee')
            <a href="{{ route('employee.dashboard') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-800">My Company</a>
          @endif
        @endauth
      </div>

      <div class="flex items-center gap-4">
        @auth
        <div class="hidden sm:flex items-center gap-4">
          <div class="text-sm text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-3 py-1 text-sm bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200">Logout</button>
          </form>
        </div>
        @else
          <a href="{{ route('login') }}" class="px-3 py-1 text-sm bg-indigo-600 text-white rounded-md">Login</a>
        @endauth
      </div>
    </div>
  </div>
</nav>
