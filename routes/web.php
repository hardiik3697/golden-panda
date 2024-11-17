<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('signin', [AuthController::class, 'signin'])->name('signin');
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

// this for route anynomus route redirect to login
Route::get("{path?}", function () {
    return redirect()->route('login');
})->where('path', '.+');