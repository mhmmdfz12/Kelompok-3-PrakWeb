<?php

namespace App\Http\Controllers;

use App\Models\User; // Ditambahkan untuk akses ke tabel users
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Ditambahkan untuk keamanan password

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 1. TAMPILKAN FORM LOGIN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('auth.login'); // Mengarah ke folder auth/login.blade.php
    }

    /*
    |--------------------------------------------------------------------------
    | 2. PROSES LOGIN ADMIN
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Cek login
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau Password salah');
    }

    /*
    |--------------------------------------------------------------------------
    | 3. TAMPILKAN FORM REGISTER (BARU)
    |--------------------------------------------------------------------------
    */
    public function registerForm()
    {
        return view('auth.register'); // Mengarah ke folder auth/register.blade.php
    }

    /*
    |--------------------------------------------------------------------------
    | 4. PROSES REGISTRASI (BARU)
    |--------------------------------------------------------------------------
    */
   public function register(Request $request)
{
    // 1. Validasi input (tambahkan username)
    $request->validate([
        'name'     => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users', // Tambahkan ini
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // 2. Simpan ke Database
    \App\Models\User::create([
        'name'     => $request->name,
        'username' => $request->username, // Tambahkan ini
        'email'    => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
}

    /*
    |--------------------------------------------------------------------------
    | 5. LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}