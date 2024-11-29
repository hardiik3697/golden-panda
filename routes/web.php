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
        /** Dashboard */
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');

            Route::controller(DashboardController::class)->group(function () {
                Route::get('/dashboard', 'dashboard')->name('dashboard');
                Route::get('profile', 'profile')->name('profile');
                Route::get('profile-update', 'profileUpdate')->name('profile.update');
                Route::post('update-profile', 'updateProfile')->name('update.profile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('password-change', 'passwordChange')->name('password.change');
            });
        /** Dashboard */

        /** access control */
            /** role */
                Route::controller(RoleController::class)->group(function () {
                    Route::any('role', 'index')->name('role');
                    Route::get('role/create', 'create')->name('role.create');
                    Route::post('role/insert', 'insert')->name('role.insert');
                    Route::get('role/update', 'update')->name('role.update');
                    Route::patch('role/alter/{id?}', 'alter')->name('role.alter');
                    Route::get('role/read', 'read')->name('role.read');
                    Route::post('role/delete', 'delete')->name('role.delete');
                });
            /** role */

            /** permission */
                Route::controller(PermissionController::class)->group(function () {
                    Route::any('permission', 'index')->name('permission');
                    Route::get('permission/create', 'create')->name('permission.create');
                    Route::post('permission/insert', 'insert')->name('permission.insert');
                    Route::get('permission/update', 'update')->name('permission.update');
                    Route::patch('permission/alter/{id?}', 'alter')->name('permission.alter');
                    Route::get('permission/read', 'read')->name('permission.read');
                    Route::post('permission/delete', 'delete')->name('permission.delete');
                });
            /** permission */

            /** access */
                Route::controller(AccessController::class)->group(function () {
                    Route::any('access', 'index')->name('access');
                    Route::get('access/update', 'update')->name('access.update');
                    Route::patch('access/alter/{id?}', 'alter')->name('access.alter');
                    Route::get('access/read', 'read')->name('access.read');
                });
            /** access */
        /** access control */

        /** user */
            Route::controller(UserController::class)->group(function () {
                Route::any('user', 'index')->name('user');
                Route::get('user/create', 'create')->name('user.create');
                Route::post('user/insert', 'insert')->name('user.insert');
                Route::get('user/update/{id?}', 'update')->name('user.update');
                Route::patch('user/alter/{id?}', 'alter')->name('user.alter');
                Route::get('user/read/{id?}', 'read')->name('user.read');
                Route::post('user/status', 'status')->name('user.status');
            });
        /** user */

        /** company */
            Route::controller(CompanyController::class)->group(function () {
                Route::any('company', 'index')->name('company');
                Route::get('company/create', 'create')->name('company.create');
                Route::post('company/insert', 'insert')->name('company.insert');
                Route::get('company/update/{id?}', 'update')->name('company.update');
                Route::patch('company/alter/{id?}', 'alter')->name('company.alter');
                Route::get('company/read/{id?}', 'read')->name('company.read');
                Route::post('company/delete', 'delete')->name('company.delete');
            });
        /** company */
    });

    // this for route anynomus route redirect to login
    Route::get("{path?}", function () {
        return redirect()->route('login');
    })->where('path', '.+');
});
