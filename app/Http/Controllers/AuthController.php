<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Paksa username ke huruf kecil dan hapus spasi berlebih (mengatasi auto-capital keyboard HP)
        $username = strtolower(trim($request->username));
        $password = $request->password;

        // Sinkronisasi otomatis akun default skripsi
        $defaultAccounts = [
            'admin' => ['name' => 'Pastor / Admin Stasi', 'email' => 'admin@stmartinus.org', 'role' => 'admin'],
            'bendahara' => ['name' => 'Bendahara Stasi Selorejo', 'email' => 'bendahara@stmartinus.org', 'role' => 'bendahara'],
            'ketua' => ['name' => 'Ketua Dewan Stasi Selorejo', 'email' => 'ketua@stmartinus.org', 'role' => 'ketua_stasi'],
        ];

        if (array_key_exists($username, $defaultAccounts) && $password === 'password123') {
            $user = User::updateOrCreate(
                ['username' => $username],
                [
                    'name' => $defaultAccounts[$username]['name'],
                    'email' => $defaultAccounts[$username]['email'],
                    'password' => Hash::make('password123'),
                    'role' => $defaultAccounts[$username]['role'],
                ]
            );

            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        // Login normal untuk akun tambahan yang dibuat oleh Admin
        if (Auth::attempt(['username' => $username, 'password' => $password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'Kombinasi Username dan Password tidak terdaftar.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
