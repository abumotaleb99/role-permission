<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\User\SupportTicket; 

// User Auth Route
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'userRegister'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'userLogin'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    // Ticket Routes
    Route::get('/tickets', [SupportTicket::class, 'index'])->name('tickets.index');
    Route::get('/tickets/add', [SupportTicket::class, 'create'])->name('tickets.create');
    Route::post('/tickets/store', [SupportTicket::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [SupportTicket::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{id}/reply', [SupportTicket::class, 'reply'])->name('tickets.reply');
});