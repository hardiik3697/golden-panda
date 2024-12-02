<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');

Route::controller(CompanyController::class)->group(function () {
    Route::get('/companies/', 'index');
    Route::post('/companies/store', 'store');
    Route::get('/companies/delete/{id}', 'delete');
});
