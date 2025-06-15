<?php

use App\Http\Controllers\API\admin\ContactController;
use App\Http\Controllers\API\client\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\client\RegisterController;
use App\Http\Middleware\CheckApiLogin;

Route::post('/client/register', [RegisterController::class, 'store']);
Route::post('/client/login', [LoginController::class, 'store']);

// ========== API ROUTE ==========
Route::prefix('admin')->name('api.admin.')->middleware(['auth:sanctum'])->group(function () {
    //quản lý liên hệ
    Route::put('contacts/{id}/restore', [ContactController::class, 'restore']);
    Route::delete('contacts/{id}/force-delete', [ContactController::class, 'forceDelete']);

    Route::apiResource('contacts', ContactController::class);
});

// Route::prefix('/products')->group(function () {
//     // http://127.0.0.1:8000/api/products
//     Route::get('/', [ProductController::class, 'index']);

//     // http://127.0.0.1:8000/api/products/1
//     Route::get('/{id}', [ProductController::class, 'show']);

//     // http://127.0.0.1:8000/api/products/add
//     Route::post('/add', [ProductController::class, 'store']);

//     // http://127.0.0.1:8000/api/products/update/1
//     Route::put('/update/{id}', [ProductController::class, 'update']);

//     // http://127.0.0.1:8000/api/products/destroy/1
//     Route::delete('/destroy/{id}', [ProductController::class, 'destroy']);
// });
