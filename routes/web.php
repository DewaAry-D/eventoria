<?php

use App\Http\Controllers\Admin\OrganisasiValidationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/organisasi/dashboard', function () {
        return view('organisasi.dashboard');
    })->name('organisasi.dashboard');

    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Route::middleware(['auth', 'organisasi.aktif'])->group(function () {
    //     // Nanti rute pembuatan event ditaruh di sini
    //     Route::get('/organisasi/event/create', function () {
    //         return "Halaman Buat Event (Hanya untuk organisasi aktif)";
    //     })->name('event.create');
        
    //     Route::post('/organisasi/event', function () {
    //         // Logika simpan event
    //     })->name('event.store');

    // });


    // Grup Khusus Admin
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // Rute Dashboard Admin (yang sudah ada sebelumnya)
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Rute Validasi Organisasi
        Route::get('/organisasi', [OrganisasiValidationController::class, 'index'])->name('organisasi.index');
        Route::get('/organisasi/{organisasi}', [OrganisasiValidationController::class, 'show'])->name('organisasi.show');
        Route::patch('/organisasi/{organisasi}/status', [OrganisasiValidationController::class, 'updateStatus'])->name('organisasi.update-status');
    });

});

require __DIR__.'/auth.php';
