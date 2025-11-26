<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SupplierController;
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

    //Suppliers
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/suppliers/getall', [SupplierController::class, 'getAll'])->name('supplier.getall');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('supplier.store');
    Route::post('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('/supplier/{id}', [SupplierController::class, 'show'])->name('supplier.show');
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    //Purchase Order
    Route::get('/purchase', [PurchaseOrderController::class, 'index'])->name('purchase.index');
    Route::get('/purchase/getall', [PurchaseOrderController::class, 'getall'])->name('purchase.getall');
    Route::post('/purchase', [PurchaseOrderController::class, 'store'])->name('purchase.store');
    Route::post('/purchase/{id}', [PurchaseOrderController::class, 'update'])->name('purchase.update');
    Route::get('/purchase/{id}', [PurchaseOrderController::class, 'show'])->name('purchase.show');
    Route::delete('/purchase/{id}', [PurchaseOrderController::class, 'destroy'])->name('purchase.destroy');

});

require __DIR__.'/auth.php';
