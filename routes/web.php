<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseInvoiceController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Users
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/getall', [UserController::class, 'getAll'])->name('user.getall');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    //Purchase Order
    Route::get('/purchase', [PurchaseOrderController::class, 'index'])->name('purchase.index');
    Route::get('/purchase/getall', [PurchaseOrderController::class, 'getall'])->name('purchase.getall');
    Route::post('/purchase', [PurchaseOrderController::class, 'store'])->name('purchase.store');
    Route::post('/purchase/{id}', [PurchaseOrderController::class, 'update'])->name('purchase.update');
    Route::get('/purchase/{id}', [PurchaseOrderController::class, 'show'])->name('purchase.show');
    Route::delete('/purchase/{id}', [PurchaseOrderController::class, 'destroy'])->name('purchase.destroy');

    //Purchase Invoice
    Route::get('/purchase-invoice', [PurchaseInvoiceController::class, 'index'])->name('pi.index');
    Route::get('/purchase-invoice/getall', [PurchaseInvoiceController::class, 'getall'])->name('pi.getall');
    Route::post('/purchase-invoice', [PurchaseInvoiceController::class, 'store'])->name('pi.store');
    Route::post('/purchase-invoice/{id}', [PurchaseInvoiceController::class, 'update'])->name('pi.update');
    Route::get('/purchase-invoice/{id}', [PurchaseInvoiceController::class, 'show'])->name('pi.show');
    Route::delete('/purchase-invoice/{id}', [PurchaseInvoiceController::class, 'destroy'])->name('pi.destroy');
});

require __DIR__.'/auth.php';
