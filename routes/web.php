<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return redirect()->route('login.form');
});

// Auth: Register
Route::get('/register', [RegisterController::class, 'show'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Auth: Login
Route::get('/login', [LoginController::class, 'show'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/patients/search', [PatientController::class, 'search'])->name('patients.search');
Route::get('/patients/filter', [PatientController::class, 'filter'])->name('patients.filter');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');

    // Patients CRUD
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

    Route::get('/patients/{id}/detail', [PatientController::class, 'detail'])->name('patients.detail');
    Route::get('/patients/{id}', [PatientController::class, 'show'])->name('patients.show');
});
