<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolesController;

Route::group(['middleware' => ['prevent-back-history']], function () {

    Route::group(['middleware' => ['guest']], function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('signIn', [AuthController::class, 'signIn'])->name('signIn');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::controller(RolesController::class)->group(function () {
            Route::any('roles', 'index')->name('roles.index');
            Route::get('roles/create', 'create')->name('roles.create');
            Route::post('roles/store', 'store')->name('roles.store');
            Route::get('roles/delete/{id?}', 'delete')->name('roles.delete');
        });
    });



    // this for route anynomus route redirect to login
    Route::get("{path?}", function () {
        return redirect()->route('login');
    })->where('path', '.+');
});
