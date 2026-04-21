<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BayaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResitController;
use App\Models\Anggota;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// auth route
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/anggota/{id}/statement', [AnggotaController::class, 'statement'])->name('anggota.statement');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/resit/{id}/print', [ResitController::class, 'print'])->name('resit.print');
    Route::post('/bayaran', [BayaranController::class, 'store'])->name('bayaran.store');
    Route::resource('anggota', AnggotaController::class);
});



