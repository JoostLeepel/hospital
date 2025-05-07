<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\FamilieController;
use App\Http\Controllers\Admin\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('dokter')) {
            return redirect()->route('dokter.dashboard');
        } elseif ($user->hasRole('patiënt')) {
            return redirect()->route('patient.dashboard');
        } elseif ($user->hasRole('familie')) {
            return redirect()->route('familie.dashboard');
        }

        abort(403); // geen geldige rol
    })->name('dashboard');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
    Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patient.dashboard');
    Route::get('/familie/dashboard', [FamilieController::class, 'index'])->name('familie.dashboard');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/appointments', [AppointmentController::class, 'index']);
            Route::get('/appointments/create', [AppointmentController::class, 'create']); 
            Route::post('/appointments', [AppointmentController::class, 'store']);
            Route::get('/appointments/data', [AppointmentController::class, 'fetch']);
        });
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
