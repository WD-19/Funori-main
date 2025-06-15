<?php

use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController; // Đảm bảo dòng này đã được thêm
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\Admin\ShippingMethodController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\Auth\LoginController;
use App\Http\Controllers\Client\Auth\RegisterController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        // Nếu là admin, chuyển về dashboard admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        // Nếu là user, chuyển về dashboard user
        return redirect()->route('client.dashboard');
    }
    // Nếu chưa đăng nhập, chuyển về trang đăng nhập
    return redirect()->route('client.login.index');
});

Route::prefix('admin')->name('admin.')
    ->middleware([CheckLogin::class])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })
            ->middleware(CheckLogin::class)
            ->name('dashboard');
        
       // Quản lý thương hiệu
       Route::patch('brands/{brand}/toggle', [BrandController::class, 'toggle'])->name('brands.toggle');


        //quản lý đánh giá
        Route::get('reviews/export', [ReviewController::class, 'export'])->name('reviews.export');
        Route::get('reviews/trash', [ReviewController::class, 'trash'])->name('reviews.trash');
        Route::put('reviews/{id}/restore', [ReviewController::class, 'restore'])->name('reviews.restore');
        Route::delete('reviews/{id}/force-delete', [ReviewController::class, 'forceDelete'])->name('reviews.forceDelete');

        //quản lý liên hệ
        Route::get('contacts/export', [ContactController::class, 'export'])->name('contacts.export');
        Route::get('contacts/trash', [ContactController::class, 'trash'])->name('contacts.trash');
        Route::put('contacts/{id}/restore', [ContactController::class, 'restore'])->name('contacts.restore');
        Route::delete('contacts/{id}/force-delete', [ContactController::class, 'forceDelete'])->name('contacts.forceDelete');

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

        // Quản lý user
        Route::get('admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
        Route::get('users/{user}/order-history', [UserController::class, 'orderHistory'])->name('users.orderHistory');

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
        // Thống kê đơn hàng (trang riêng)
        Route::get('orders-stats', [OrderController::class, 'stats'])->name('orders.stats');
        // Xuất file Excel/CSV đơn hàng
        Route::get('orders-export', [OrderController::class, 'export'])->name('orders.export');
        // banner
        Route::post('banners/reorder', [BannerController::class, 'reorder'])->name('banners.reorder');
        Route::post('banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');
        // Login và Register

        Route::resource('products', ProductController::class);
        Route::resource('attributes', AttributeController::class);
        Route::resource('users', UserController::class);
        Route::resource('promotions', PromotionController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('pages', PageController::class);
        Route::resource('reviews', ReviewController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('brands', BrandController::class);

        Route::fallback(function () {
            return response()->view('admin.errors.404', [], 404);
        });
    });



Route::prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', function () {
        return view('client.index');
    })->name('dashboard');

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.index');
    Route::post('/login', [LoginController::class, 'login']);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::fallback(function () {
        return response()->view('client.errors.404', [], 404);
    });
});
