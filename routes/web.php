<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/',[AuthController::class,'showLogin'])->name('showLogin');
Route::post('/login',[AuthController::class,'login'])->name('login');
// Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
 Route::middleware(['auth'])->group(function(){
    //rutas usuarios autenticados
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
});