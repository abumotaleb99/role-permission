<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Admin Auth Route
Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::get('/password/forget', [AuthController::class, 'showForgetPasswordForm'])->name('admin.forget.password.form');
Route::post('/password/forget', [AuthController::class, 'sendResetPasswordEmail'])->name('admin.forget.password');
Route::get('/password/reset', [AuthController::class, 'showResetPasswordForm'])->name('admin.reset.password.form');
Route::post('/password/reset/{token}', [AuthController::class, 'resetPassword'])->name('admin.reset.password');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
