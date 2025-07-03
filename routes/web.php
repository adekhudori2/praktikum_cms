<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect awal
Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk admin - hanya bisa akses fitur admin
Route::middleware(['auth:web', 'admin'])->group(function () {
    // Dashboard admin
    Route::get('/admin/dashboard', function () {
        $admin = auth()->guard('web')->user();
        $mahasiswas = \App\Models\Mahasiswa::all();
        return view('admin.dashboard', compact('admin', 'mahasiswas'));
    })->name('admin.dashboard');

    // Route CRUD mahasiswa hanya untuk admin
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::get('/mahasiswa/{id}/delete', [MahasiswaController::class, 'delete'])->name('mahasiswa.delete');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

// Route untuk mahasiswa - hanya bisa akses fitur mahasiswa
Route::middleware(['auth:mahasiswa', 'mahasiswa'])->group(function () {
    // Dashboard mahasiswa
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    
    // Mahasiswa hanya bisa edit profil sendiri
    Route::get('/profile/edit', [MahasiswaController::class, 'editProfile'])->name('mahasiswa.profile.edit');
    Route::put('/profile/update', [MahasiswaController::class, 'updateProfile'])->name('mahasiswa.profile.update');
});
