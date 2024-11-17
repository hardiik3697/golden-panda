<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolesController;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('signIn', [AuthController::class, 'signIn'])->name('signIn');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::any('/roles', [RolesController::class, 'index'])->name('roles.index');

// this for route anynomus route redirect to login
Route::get("{path?}", function () {
    return redirect()->route('login');
})->where('path', '.+');