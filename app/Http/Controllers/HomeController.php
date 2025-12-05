<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Redirect user ke halaman sesuai role masing-masing.
     */
    public function index()
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->role === 'owner') {
            return redirect()->route('owner.companies.index');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.companies.select');
        }

        if ($user->role === 'employee') {
            // employee akan diarahkan ke route bernama 'dashboard'
            return redirect()->route('dashboard');
        }

        abort(403);
    }

    /**
     * Menampilkan halaman dashboard umum (dipakai setelah login).
     * Anda bisa menyesuaikan view sesuai kebutuhan role.
     */
    public function dashboard()
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        // contoh: jika ingin send data khusus per role, siapkan di sini
        if ($user->role === 'employee') {
            $company = $user->company;
            return view('employees.dashboard', compact('user','company'));
        }

        // owner/admin fallback ke view dashboard umum
        return view('dashboard', compact('user'));
    }
}
