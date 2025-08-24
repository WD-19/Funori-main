<?php

use App\Http\Controllers\API\admin\ContactController;
use App\Http\Controllers\API\admin\ReviewController;
use App\Http\Controllers\API\client\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\ProductController;
use App\Http\Controllers\API\client\RegisterController;
use App\Http\Controllers\API\ShipperAppController;
use App\Http\Middleware\CheckApiLogin;

Route::post('/client/register', [RegisterController::class, 'store']);
Route::post('/client/login', [LoginController::class, 'store']);

// ========== SHIPPER APP API ==========
Route::prefix('shipper-app')->name('api.shipper-app.')->group(function () {
    // Public routes
    Route::post('/login', [ShipperAppController::class, 'login'])->name('login');
    
    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // Profile management
        Route::get('/profile', [ShipperAppController::class, 'getProfile'])->name('profile');
        Route::put('/profile', [ShipperAppController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [ShipperAppController::class, 'changePassword'])->name('password.change');
        
        // Orders management
        Route::get('/orders', [ShipperAppController::class, 'getOrders'])->name('orders');
        Route::get('/orders/{id}', [ShipperAppController::class, 'getOrder'])->name('orders.show');
        Route::post('/orders/{id}/status', [ShipperAppController::class, 'updateOrderStatus'])->name('orders.status');
        
        // Notifications
        Route::get('/notifications', [ShipperAppController::class, 'getNotifications'])->name('notifications');
        Route::put('/notifications/{id}/read', [ShipperAppController::class, 'markNotificationAsRead'])->name('notifications.read');
        Route::put('/notifications/mark-all-read', [ShipperAppController::class, 'markAllNotificationsAsRead'])->name('notifications.read-all');
        
        // Location tracking
        Route::post('/location', [ShipperAppController::class, 'updateLocation'])->name('location.update');
        
        // Logout
        Route::post('/logout', [ShipperAppController::class, 'logout'])->name('logout');
    });
});

// ========== API ROUTE ==========
Route::prefix('admin')->name('api.admin.')->middleware(['auth:sanctum'])->group(function () {
    //quản lý liên hệ
    Route::put('contacts/{id}/restore', [ContactController::class, 'restore']);
    Route::delete('contacts/{id}/force-delete', [ContactController::class, 'forceDelete']);

    //quản lý đánh giá
    Route::put('reviews/{id}/restore', [ReviewController::class, 'restore']);
    Route::delete('reviews/{id}/force-delete', [ReviewController::class, 'forceDelete']);

    Route::apiResource('contacts', ContactController::class);
    Route::apiResource('reviews', ReviewController::class);

    Route::get('chat-notifications', [App\Http\Controllers\Admin\MessageController::class, 'getNotifications'])
    ->name('chat.notifications');
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
