<?php

use App\Http\Controllers\Admin\EventValidationController;
use App\Http\Controllers\Admin\OrganisasiValidationController;
use App\Http\Controllers\Organisasi\EventController;
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



    // Grup Khusus Organisasi yang sudah AKTIF
    Route::middleware(['auth', 'organisasi.aktif'])->prefix('organisasi')->name('organisasi.')->group(function () {
        Route::get('/event', [EventController::class, 'index'])->name('event.index');
        Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
        Route::post('/event', [EventController::class, 'store'])->name('event.store');

        Route::get('/event/{event}/katalog', [EventController::class, 'katalog'])->name('event.katalog');
        Route::get('/event/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
        Route::put('/event/{event}', [EventController::class, 'update'])->name('event.update');

        Route::get('/event/{event}/sertifikat', [\App\Http\Controllers\Organisasi\SertifikatController::class, 'index'])->name('event.sertifikat');
        Route::post('/event/{event}/sertifikat/template', [\App\Http\Controllers\Organisasi\SertifikatController::class, 'updateTemplate'])->name('event.sertifikat.template');
        Route::post('/event/{event}/sertifikat/peserta', [\App\Http\Controllers\Organisasi\SertifikatController::class, 'importPeserta'])->name('event.sertifikat.peserta');

    });


    // Grup Khusus Admin
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/organisasi', [OrganisasiValidationController::class, 'index'])->name('organisasi.index');
        Route::get('/organisasi/{organisasi}', [OrganisasiValidationController::class, 'show'])->name('organisasi.show');
        Route::patch('/organisasi/{organisasi}/status', [OrganisasiValidationController::class, 'updateStatus'])->name('organisasi.update-status');

        Route::get('/event', [EventValidationController::class, 'index'])->name('event.index');
        Route::get('/event/{event}', [EventValidationController::class, 'show'])->name('event.show');
        Route::patch('/event/{event}/status', [EventValidationController::class, 'updateStatus'])->name('event.update-status');
    });

});

require __DIR__.'/auth.php';
