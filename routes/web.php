<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController; 
use App\Http\Controllers\Admin\AdminController;

// Admin Auth Route
Route::redirect('/', '/login');
Route::name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login');
    Route::get('/password/forget', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password.form');
    Route::post('/password/forget', [AuthController::class, 'sendResetPasswordEmail'])->name('forget.password');
    Route::get('/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.form');
    Route::post('/password/reset/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/add', [AdminController::class, 'add'])->name('admins.add');
    Route::post('/admins/add', [AdminController::class, 'insert'])->name('admins.insert');
    Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::post('/admins/edit', [AdminController::class, 'update'])->name('admins.update');
    Route::get('/admins/{id}/delete', [AdminController::class, 'delete'])->name('admins.delete');
});