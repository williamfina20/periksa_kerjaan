<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BerandaController as AdminBeranda;
use App\Http\Controllers\Admin\PenggunaController as AdminPengguna;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswa;
use App\Http\Controllers\Admin\ProgressController as AdminProgress;

use App\Http\Controllers\User\BerandaController as UserBeranda;
use App\Http\Controllers\User\MahasiswaController as UserMahasiswa;
use App\Http\Controllers\User\ProgressController as UserProgress;

Route::get('/', function () {
    return view('auth.login');
});

// Untuk storage link
Route::get('/generate_link', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return 'oke berhasil generate link';
});

Route::get('/tes', function () {
    return view('tes');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/beranda', [AdminBeranda::class, 'index'])->name('admin.beranda');

    Route::get('/admin/pengguna', [AdminPengguna::class, 'index'])->name('admin.pengguna');
    Route::get('/admin/pengguna/create', [AdminPengguna::class, 'create'])->name('admin.pengguna.create');
    Route::post('/admin/pengguna', [AdminPengguna::class, 'store'])->name('admin.pengguna.store');
    Route::get('/admin/pengguna/{id}/edit', [AdminPengguna::class, 'edit'])->name('admin.pengguna.edit');
    Route::put('/admin/pengguna/{id}', [AdminPengguna::class, 'update'])->name('admin.pengguna.update');
    Route::delete('/admin/pengguna/{id}', [AdminPengguna::class, 'destroy'])->name('admin.pengguna.destroy');

    Route::get('/admin/mahasiswa', [AdminMahasiswa::class, 'index'])->name('admin.mahasiswa');

    Route::get('/admi/progress', [AdminProgress::class, 'index'])->name('admin.progress');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/beranda', [UserBeranda::class, 'index'])->name('user.beranda');

    Route::get('/user/mahasiswa', [UserMahasiswa::class, 'index'])->name('user.mahasiswa');
    Route::get('/user/mahasiswa/create', [UserMahasiswa::class, 'create'])->name('user.mahasiswa.create');
    Route::post('/user/mahasiswa', [UserMahasiswa::class, 'store'])->name('user.mahasiswa.store');
    Route::get('/user/mahasiswa/{id}/edit', [UserMahasiswa::class, 'edit'])->name('user.mahasiswa.edit');
    Route::put('/user/mahasiswa/{id}', [UserMahasiswa::class, 'update'])->name('user.mahasiswa.update');
    Route::delete('/user/mahasiswa/{id}', [UserMahasiswa::class, 'destroy'])->name('user.mahasiswa.destroy');

    Route::get('/user/progress', [UserProgress::class, 'index'])->name('user.progress');
    Route::get('/user/progress/create', [UserProgress::class, 'create'])->name('user.progress.create');
    Route::post('/user/progress', [UserProgress::class, 'store'])->name('user.progress.store');
    Route::get('/user/progress/{id}/edit', [UserProgress::class, 'edit'])->name('user.progress.edit');
    Route::put('/user/progress/{id}', [UserProgress::class, 'update'])->name('user.progress.update');
    Route::delete('/user/progress/{id}', [UserProgress::class, 'destroy'])->name('user.progress.destroy');
});

require __DIR__ . '/auth.php';
