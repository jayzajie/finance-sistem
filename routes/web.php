<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', App\Http\Controllers\UserController::class);

    // Account Management (Rekening)
    Route::resource('accounts', App\Http\Controllers\AccountController::class);

    // Category Management
    Route::resource('categories', App\Http\Controllers\CategoryController::class);

    // Transaction Management
    Route::get('/transactions/income', [App\Http\Controllers\TransactionController::class, 'income'])->name('transactions.income');
    Route::get('/transactions/expense', [App\Http\Controllers\TransactionController::class, 'expense'])->name('transactions.expense');
    Route::resource('transactions', App\Http\Controllers\TransactionController::class);

    // Invoice Management
    Route::resource('invoices', App\Http\Controllers\InvoiceController::class);

    // Debt Management (Hutang/Piutang)
    Route::resource('debts', App\Http\Controllers\DebtController::class);

    // Reports
    Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
