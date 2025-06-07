<?php

use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingMethodController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');
    // Payment Methods
    Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
    Route::get('/payment-methods/create', [PaymentMethodController::class, 'create'])->name('payment_methods.create');
    Route::post('/payment-methods', [PaymentMethodController::class, 'store'])->name('payment_methods.store');
    Route::delete('/payment-methods/{id}', [PaymentMethodController::class, 'destroy'])->name('payment_methods.destroy');
    Route::put('/payment-methods/{id}/toggle', [PaymentMethodController::class, 'toggle'])->name('payment_methods.toggle');
    // Shipping Methods
    Route::get('/shipping-methods', [ShippingMethodController::class, 'index'])->name('shipping_methods.index');
    Route::get('/shipping-methods/create', [ShippingMethodController::class, 'create'])->name('shipping_methods.create');
    Route::post('/shipping-methods', [ShippingMethodController::class, 'store'])->name('shipping_methods.store');
    Route::delete('/shipping-methods/{id}', [ShippingMethodController::class, 'destroy'])->name('shipping_methods.destroy');
    Route::patch('/shipping-methods/{id}/deactivate', [ShippingMethodController::class, 'deactivate'])->name('shipping_methods.deactivate');
    Route::patch('/shipping-methods/{id}/activate', [ShippingMethodController::class, 'activate'])->name('shipping_methods.activate');

    Route::resource('products', ProductController::class);
    Route::resource('attributes', AttributeController::class);
});
