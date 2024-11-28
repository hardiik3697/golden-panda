<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

Route::group(['middleware' => ['prevent-back-history']], function(){
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/singin', [AuthController::class, 'singin'])->name('singin');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
        Route::get('profile-update', [DashboardController::class, 'profileUpdate'])->name('profile.update');
        Route::post('update-profile', [DashboardController::class, 'updateProfile'])->name('update.profile');
        Route::get('change-password', [DashboardController::class, 'changePassword'])->name('change.password');
        Route::post('password-change', [DashboardController::class, 'passwordChange'])->name('password.change');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        /** access control */
            /** role */
                Route::any('role', [RoleController::class, 'index'])->name('role');
                Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
                Route::post('role/insert', [RoleController::class, 'insert'])->name('role.insert');
                Route::get('role/update', [RoleController::class, 'update'])->name('role.update');
                Route::patch('role/alter/{id?}', [RoleController::class, 'alter'])->name('role.alter');
                Route::get('role/read', [RoleController::class, 'read'])->name('role.read');
                Route::post('role/delete', [RoleController::class, 'delete'])->name('role.delete');
            /** role */

            /** permission */
                Route::any('permission', [PermissionController::class, 'index'])->name('permission');
                Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
                Route::post('permission/insert', [PermissionController::class, 'insert'])->name('permission.insert');
                Route::get('permission/update', [PermissionController::class, 'update'])->name('permission.update');
                Route::patch('permission/alter/{id?}', [PermissionController::class, 'alter'])->name('permission.alter');
                Route::get('permission/read', [PermissionController::class, 'read'])->name('permission.read');
                Route::post('permission/delete', [PermissionController::class, 'delete'])->name('permission.delete');
            /** permission */

            /** access */
                Route::any('access', [AccessController::class, 'index'])->name('access');
                Route::get('access/update', [AccessController::class, 'update'])->name('access.update');
                Route::patch('access/alter/{id?}', [AccessController::class, 'alter'])->name('access.alter');
                Route::get('access/read', [AccessController::class, 'read'])->name('access.read');
            /** access */
        /** access control */

        /** user */
            Route::any('user', [UserController::class, 'index'])->name('user');
            Route::get('user/create', [UserController::class, 'create'])->name('user.create');
            Route::post('user/insert', [UserController::class, 'insert'])->name('user.insert');
            Route::get('user/update/{id?}', [UserController::class, 'update'])->name('user.update');
            Route::patch('user/alter/{id?}', [UserController::class, 'alter'])->name('user.alter');
            Route::get('user/read/{id?}', [UserController::class, 'read'])->name('user.read');
            Route::post('user/status', [UserController::class, 'status'])->name('user.status');
        /** user */

        /** company */
            Route::any('company', [CompanyController::class, 'index'])->name('company');
            Route::get('company/create', [CompanyController::class, 'create'])->name('company.create');
            Route::post('company/insert', [CompanyController::class, 'insert'])->name('company.insert');
            Route::get('company/update/{id?}', [CompanyController::class, 'update'])->name('company.update');
            Route::patch('company/alter/{id?}', [CompanyController::class, 'alter'])->name('company.alter');
            Route::get('company/read/{id?}', [CompanyController::class, 'read'])->name('company.read');
            Route::post('company/delete', [CompanyController::class, 'delete'])->name('company.delete');
        /** company */
    });

    // this for route anynomus route redirect to login
    Route::get("{path?}", function () {
        return redirect()->route('login');
    })->where('path', '.+');
});
