<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
     public function showLogin()
    {
        return view('login.login'); // pastikan file ada di resources/views/login/login.blade.php
    }

    // Menampilkan halaman registrasi
    public function showRegister()
    {
        return view('login.register'); // pastikan file ada di resources/views/login/register.blade.php
    }

    // Proses registrasi user baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:usersacc,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer' // default sebagai customer
        ]);

        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.beranda');
            } else {
                return redirect()->route('index');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
