<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('vendors', VendorController::class);
    Route::resource('products', ProductController::class);
    Route::resource('invoices', InvoiceController::class);
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');
    Route::post('invoices/{invoice}/send', [InvoiceController::class, 'send'])->name('invoices.send');
    
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');
        Route::post('admin/users/{user}/archive', [DashboardController::class, 'archiveUser'])->name('admin.users.archive');
    });
});

require __DIR__.'/auth.php';
