<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\StockMovementController;
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

    //Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customers/getall', [CustomerController::class, 'getAll'])->name('customer.getall');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    //Items
    Route::get('/items', [ItemController::class, 'index'])->name('item.index');
    Route::get('/items/getall', [ItemController::class, 'getAll'])->name('item.getall');
    Route::post('/items', [ItemController::class, 'store'])->name('item.store');
    Route::post('/item/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');
    Route::delete('/item/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

    //Purchase Requests
    Route::get('/purchase-requests', [PurchaseRequestController::class, 'index'])->name('pr.index');
    Route::get('/purchase-requests/getall', [PurchaseRequestController::class, 'getAll'])->name('pr.getall');
    Route::post('/purchase-requests', [PurchaseRequestController::class, 'store'])->name('pr.store');
    Route::post('/purchase-request/{id}', [PurchaseRequestController::class, 'update'])->name('pr.update');
    Route::get('/purchase-request/{id}', [PurchaseRequestController::class, 'show'])->name('pr.show');
    Route::delete('/purchase-request/{id}', [PurchaseRequestController::class, 'destroy'])->name('pr.destroy');

    //Purchase Orders
    Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])->name('po.index');
    Route::get('/purchase-orders/getall', [PurchaseOrderController::class, 'getAll'])->name('po.getall');
    Route::post('/purchase-orders', [PurchaseOrderController::class, 'store'])->name('po.store');
    Route::post('/purchase-order/{id}', [PurchaseOrderController::class, 'update'])->name('po.update');
    Route::get('/purchase-order/{id}', [PurchaseOrderController::class, 'show'])->name('po.show');
    Route::delete('/purchase-order/{id}', [PurchaseOrderController::class, 'destroy'])->name('po.destroy');

    //Stock Movements
    Route::get('/stock-movements', [StockMovementController::class, 'index'])->name('sm.index');
    Route::get('/stock-movements/getall', [StockMovementController::class, 'getAll'])->name('sm.getall');
    Route::post('/stock-movements', [StockMovementController::class, 'store'])->name('sm.store');
    Route::post('/stock-movement/{id}', [StockMovementController::class, 'update'])->name('sm.update');
    Route::get('/stock-movement/{id}', [StockMovementController::class, 'show'])->name('sm.show');
    Route::delete('/stock-movement/{id}', [StockMovementController::class, 'destroy'])->name('sm.destroy');

    //Sales Orders
    Route::get('/sales-orders', [SalesOrderController::class, 'index'])->name('so.index');
    Route::get('/sales-orders/getall', [SalesOrderController::class, 'getAll'])->name('so.getall');
    Route::post('/sales-orders', [SalesOrderController::class, 'store'])->name('so.store');
    Route::post('/sales-order/{id}', [SalesOrderController::class, 'update'])->name('so.update');
    Route::get('/sales-order/{id}', [SalesOrderController::class, 'show'])->name('so.show');
    Route::delete('/sales-order/{id}', [SalesOrderController::class, 'destroy'])->name('so.destroy');

    //Invoices
    Route::get('/invoices', [InvoiceController::class, 'invoices'])->name('invoice.index');
    Route::get('/invoices/getall', [InvoiceController::class, 'getAll'])->name('invoice.getall');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::post('/invoice/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::delete('/invoice/{id}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');

    //Payments
    Route::get('/payments', [PaymentController::class, 'payments'])->name('payment.index');
    Route::get('/payments/getall', [PaymentController::class, 'getAll'])->name('payment.getall');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/payment/{id}', [PaymentController::class, 'update'])->name('payment.update');
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::delete('/payment/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');

});

require __DIR__.'/auth.php';
