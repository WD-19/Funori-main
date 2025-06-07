<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\admin\ReviewController;
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
    Route::resource('categories', CategoryController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('reviews', ReviewController::class);

    // Quản lý đơn hàng
    // (1) Xem danh sách đơn hàng, hỗ trợ filter theo trạng thái, tìm kiếm
    Route::get('orders', [OrderController::class, 'index'])
        ->name('orders.index');

    // (2) Xem chi tiết một đơn hàng
    Route::get('orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    // (3) Hiển thị form sửa đơn hàng (chỉnh thông tin, cập nhật toàn bộ)
    Route::get('orders/{order}/edit', [OrderController::class, 'edit'])
        ->name('orders.edit');

    // (4) Cập nhật toàn bộ thông tin đơn hàng (store & update các trường order)
    Route::put('orders/{order}', [OrderController::class, 'update'])
        ->name('orders.update');

    // (5) Xóa đơn hàng
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])
        ->name('orders.destroy');

    // (6) Cập nhật trạng thái riêng (VD: processing → shipped → delivered → cancelled → returned)
    Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');

    // (6.1) Trang tracking trạng thái đơn hàng (form cập nhật trạng thái riêng)
    Route::get('orders/{order}/tracking', [OrderController::class, 'tracking'])
        ->name('orders.tracking');

    // (7) Xử lý yêu cầu hủy đơn (khách hàng đã gửi “request cancel”), admin duyệt/không duyệt
    Route::post('orders/{order}/process-cancel', [OrderController::class, 'processCancel'])
        ->name('orders.processCancel');

    // (8) In hóa đơn (HTML hoặc PDF)
    Route::get('orders/{order}/print-invoice', [OrderController::class, 'printInvoice'])
        ->name('orders.printInvoice');

    // (9) In phiếu giao hàng
    Route::get('orders/{order}/print-shipping', [OrderController::class, 'printShipping'])
        ->name('orders.printShipping');
});
