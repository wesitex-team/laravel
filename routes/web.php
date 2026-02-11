<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::view('/admin/dashboard', 'dashboards.admin.admin-dashboard')->name('admin.dashboard');
    Route::view('/hr/dashboard', 'dashboards.hr.hr-dashboard')->name('hr.dashboard');
    Route::view('/employees/dashboard', 'dashboards.employees.employees-dashboard')->name('employees.dashboard');
});

