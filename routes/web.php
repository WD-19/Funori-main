<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('attributes', AttributeController::class);
});
