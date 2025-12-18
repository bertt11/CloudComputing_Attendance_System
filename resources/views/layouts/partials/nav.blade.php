<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- LEFT --}}
            <div class="flex items-center gap-6">

                {{-- Logo --}}
                <a href="
                    @auth
                        @if(Auth::user()->role === 'owner')
                            {{ route('owner.dashboard') }}
                        @elseif(Auth::user()->role === 'admin')
                            {{ route('admin.dashboard') }}
                        @elseif(Auth::user()->role === 'employee')
                            {{ route('employee.dashboard') }}
                        @else
                            /
                        @endif
                    @else
                        /
                    @endauth
                "
                class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    AttendanceSystem
                </a>

                {{-- OWNER MENU --}}
                @auth
                    @if(Auth::user()->role === 'owner')
                        <a href="{{ route('owner.dashboard') }}"
                           class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Dashboard
                        </a>

                        <a href="{{ route('owner.companies.index') }}"
                           class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Perusahaan
                        </a>

                        <a href="{{ route('owner.employees.index') }}"
                           class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Karyawan
                        </a>
                    @endif
                @endauth

                {{-- ADMIN MENU --}}
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Dashboard
                        </a>

                        <a href="{{ route('admin.permissions.index') }}"
                           class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Kelola Izin
                        </a>

                        <a href="{{ route('admin.attendances.index') }}"
                           class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Kelola Absensi
                        </a>
                    @endif
                @endauth

                {{-- EMPLOYEE MENU --}}
                @auth
                    @if(Auth::user()->role === 'employee')
                        <a href="{{ route('employee.dashboard') }}"
                           class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Dashboard
                        </a>

                        <a href="{{ route('employee.permission.create') }}"
                           class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Ajukan Izin
                        </a>
                    @endif
                @endauth

            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-4">
                @auth
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-700 dark:text-gray-200">
                            {{ Auth::user()->name }}
                        </span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="px-3 py-1 text-sm bg-gray-100 dark:bg-gray-700 rounded-md
                                       hover:bg-gray-200 dark:hover:bg-gray-600">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="px-3 py-1 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Login
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>
