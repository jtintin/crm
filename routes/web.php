<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });
// Mostrar formulario en /login
Route::get('/', [AuthController::class, 'showLogin'])->name('loginx');

// Procesar credenciales
Route::post('/login', [AuthController::class, 'login'])->name('authUser');

// Logout (POST recomendado)
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Área protegida
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::put('/clients/activate/{client}',[ClientController::class,'activate'])->name('clients.activate');
    Route::get('/clients/deleted',[ClientController::class,'deleted'])->name('clients.deleted');
    Route::resource('clients',ClientController::class);
});
