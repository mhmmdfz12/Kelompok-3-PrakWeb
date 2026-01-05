<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IbuController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\VitaminController;

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN ADMIN SAJA)
|--------------------------------------------------------------------------
*/

// Halaman awal langsung ke login
Route::get('/', [AuthController::class, 'index'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route untuk Register
// Pastikan registerForm() dan register() ada di AuthController
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| HALAMAN YANG WAJIB LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ================= DATA IBU =================
    Route::resource('ibu', IbuController::class);

    // ================= DATA KADER =================
    Route::resource('kader', KaderController::class);

    // ================= JADWAL POSYANDU =================
    Route::resource('jadwal', JadwalController::class);

    // ================= IMUNISASI =================
    Route::resource('imunisasi', ImunisasiController::class)->except(['edit', 'update', 'show']);

    // ================= VITAMIN =================
    Route::resource('vitamin', VitaminController::class)->except(['edit', 'update', 'show']);

    // ================= BALITA =================
    // Cetak PDF (HARUS di atas resource agar tidak dianggap ID balita)
    Route::get('/balita/cetak-pdf', [BalitaController::class, 'cetakPdf'])
        ->name('balita.cetak_pdf');

    // CRUD Balita (Menyediakan index, create, store, edit, update, destroy, show)
    Route::resource('balita', BalitaController::class)
        ->parameters(['balita' => 'balita']);

    // ================= PENIMBANGAN =================
    // 1. Tampilan Daftar Riwayat Penimbangan (Untuk menu Sidebar)
    Route::get('/penimbangan', [PenimbanganController::class, 'index'])
        ->name('penimbangan.index');

    // 2. Simpan Data Penimbangan Balita Spesifik
    Route::post('balita/{balita}/penimbangan', [PenimbanganController::class, 'store'])
        ->name('penimbangan.store');

    // 3. Hapus Data Penimbangan
    Route::delete('penimbangan/{penimbangan}', [PenimbanganController::class, 'destroy'])
        ->name('penimbangan.destroy');
});