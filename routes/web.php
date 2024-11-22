<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AccessController;

Route::group(['middleware' => ['prevent-back-history']], function(){
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/singin', [AuthController::class, 'singin'])->name('singin');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        /** access control */
            /** role */
                Route::any('role', [RoleController::class, 'index'])->name('role');
                Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
                Route::post('role/insert', [RoleController::class, 'insert'])->name('role.insert');
                Route::get('role/edit', [RoleController::class, 'edit'])->name('role.edit');
                Route::patch('role/update/{id?}', [RoleController::class, 'update'])->name('role.update');
                Route::get('role/view', [RoleController::class, 'view'])->name('role.view');
                Route::post('role/delete', [RoleController::class, 'delete'])->name('role.delete');
            /** role */

            /** permission */
                Route::any('permission', [PermissionController::class, 'index'])->name('permission');
                Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
                Route::post('permission/insert', [PermissionController::class, 'insert'])->name('permission.insert');
                Route::get('permission/edit', [PermissionController::class, 'edit'])->name('permission.edit');
                Route::patch('permission/update/{id?}', [PermissionController::class, 'update'])->name('permission.update');
                Route::get('permission/view', [PermissionController::class, 'view'])->name('permission.view');
                Route::post('permission/delete', [PermissionController::class, 'delete'])->name('permission.delete');
            /** permission */

            /** access */
                Route::any('access', [AccessController::class, 'index'])->name('access');
                Route::get('access/edit', [AccessController::class, 'edit'])->name('access.edit');
                Route::patch('access/update/{id?}', [AccessController::class, 'update'])->name('access.update');
                Route::get('access/view', [AccessController::class, 'view'])->name('access.view');
            /** access */
        /** access control */
    });

    // this for route anynomus route redirect to login
    Route::get("{path?}", function () {
        return redirect()->route('login');
    })->where('path', '.+');
});