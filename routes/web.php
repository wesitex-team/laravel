<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::middleware(['jwt.verify'])->group(function () {
    Route::view('/admin/dashboard', 'dashboards.admin.admin-dashboard')->name('admin.dashboard');
    Route::get('/admin/users', [App\Http\Controllers\admin\users\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [App\Http\Controllers\admin\users\AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [App\Http\Controllers\admin\users\AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [App\Http\Controllers\admin\users\AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [App\Http\Controllers\admin\users\AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::view('/hr/dashboard', 'dashboards.hr.hr-dashboard')->name('hr.dashboard');
    Route::view('/employees/dashboard', 'dashboards.employees.employees-dashboard')->name('employees.dashboard');
});

