<?php
//Admin Controller
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ShippingMethodController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\Admin\ShipperController;
use App\Http\Controllers\admin\RefundController;
// Middleware
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')
    ->middleware([CheckLogin::class])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->middleware(CheckLogin::class)
            ->name('dashboard');

        Route::get('dashboard/data', [DashboardController::class, 'fetchData'])->name('dashboard.data');

        // Quản lý thương hiệu
        Route::patch('brands/{brand}/toggle', [BrandController::class, 'toggle'])->name('brands.toggle');

        // Quản lý đoạn chat
        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('message/messages/{id}', [MessageController::class, 'messages'])->name('messages.messages');
        Route::post('message/messages/{id}', [MessageController::class, 'store'])->name('messages.store');
        Route::delete('messages/{id}', [MessageController::class, 'delete'])->name('messages.delete');
        Route::post('/admin/message/messages/{id}/file', [MessageController::class, 'sendFile'])->name('message.sendFile');

        //quản lý đánh giá
        Route::get('reviews/export', [ReviewController::class, 'export'])->name('reviews.export');
        Route::get('reviews/trash', [ReviewController::class, 'trash'])->name('reviews.trash');
        Route::put('reviews/{id}/restore', [ReviewController::class, 'restore'])->name('reviews.restore');
        Route::delete('reviews/{id}/force-delete', [ReviewController::class, 'forceDelete'])->name('reviews.forceDelete');

        // Quản lý pages
        Route::post('pages/upload-image', [PageController::class, 'uploadImage'])->name('pages.upload-image');

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
        Route::get('/payment-methods/{id}/edit', [PaymentMethodController::class, 'edit'])->name('payment_methods.edit');
        Route::put('/payment-methods/{id}', [PaymentMethodController::class, 'update'])->name('payment_methods.update');

        // Shipping Methods
        Route::get('/shipping-methods', [ShippingMethodController::class, 'index'])->name('shipping_methods.index');
        Route::get('/shipping-methods/create', [ShippingMethodController::class, 'create'])->name('shipping_methods.create');
        Route::post('/shipping-methods', [ShippingMethodController::class, 'store'])->name('shipping_methods.store');
        Route::delete('/shipping-methods/{id}', [ShippingMethodController::class, 'destroy'])->name('shipping_methods.destroy');
        Route::patch('/shipping-methods/{id}/deactivate', [ShippingMethodController::class, 'deactivate'])->name('shipping_methods.deactivate');
        Route::patch('/shipping-methods/{id}/activate', [ShippingMethodController::class, 'activate'])->name('shipping_methods.activate');
        Route::get('/shipping-methods/{id}/edit', [ShippingMethodController::class, 'edit'])->name('shipping_methods.edit');
        Route::put('/shipping-methods/{id}', [ShippingMethodController::class, 'update'])->name('shipping_methods.update');

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
        // (2.1) Lấy thông tin delivery cho modal
        Route::get('orders/{order}/delivery-info', [OrderController::class, 'getDeliveryInfo'])
            ->name('orders.delivery-info');
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

        // Quản lý refund
        Route::get('refunds', [RefundController::class, 'index'])->name('refunds.index');
        Route::get('refunds/{refund}', [RefundController::class, 'show'])->name('refunds.show');
        Route::post('refunds/{refund}/mark-success', [RefundController::class, 'markAsSuccess'])->name('refunds.mark-success');
        Route::post('refunds/{refund}/mark-failed', [RefundController::class, 'markAsFailed'])->name('refunds.mark-failed');
        Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');
        // (6.1) Trang tracking trạng thái đơn hàng (form cập nhật trạng thái riêng)
        Route::get('orders/{order}/tracking', [OrderController::class, 'tracking'])
            ->name('orders.tracking');
        // (7) Xử lý yêu cầu hủy đơn (khách hàng đã gửi "request cancel"), admin duyệt/không duyệt
        Route::post('orders/{order}/process-cancel', [OrderController::class, 'processCancel'])
            ->name('orders.processCancel');
        // (8) In hóa đơn (HTML hoặc PDF)
        Route::get('orders/{order}/print-invoice', [OrderController::class, 'printInvoice'])
            ->name('orders.printInvoice');
        // (9) In phiếu giao hàng
        Route::get('orders/{order}/print-shipping', [OrderController::class, 'printShipping'])
            ->name('orders.printShipping');
        // (10) Gán và đổi shipper
        Route::post('orders/{order}/assign-shipper', [OrderController::class, 'assignShipper'])
            ->name('orders.assign-shipper');
        Route::post('orders/{order}/change-shipper', [OrderController::class, 'changeShipper'])
            ->name('orders.change-shipper');
        // Thống kê đơn hàng (trang riêng)
        Route::get('orders-stats', [OrderController::class, 'stats'])->name('orders.stats');
        // Xuất file Excel/CSV đơn hàng
        Route::get('orders-export', [OrderController::class, 'export'])->name('orders.export');
        
        // banner
        Route::post('banners/reorder', [BannerController::class, 'reorder'])->name('banners.reorder');
        Route::post('banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');

        // Quản lý shipper
        Route::prefix('shippers')->name('shippers.')->group(function () {
            Route::get('/', [ShipperController::class, 'index'])->name('index');
            Route::get('/create', [ShipperController::class, 'create'])->name('create');
            Route::post('/', [ShipperController::class, 'store'])->name('store');
            Route::get('/{shipper}', [ShipperController::class, 'show'])->name('show');
            Route::get('/{shipper}/edit', [ShipperController::class, 'edit'])->name('edit');
            Route::put('/{shipper}', [ShipperController::class, 'update'])->name('update');
            Route::delete('/{shipper}', [ShipperController::class, 'destroy'])->name('destroy');
            
            // Phân chia đơn hàng
            Route::get('/assign/orders', [ShipperController::class, 'assignOrders'])->name('assign-orders');
            Route::post('/assign/process', [ShipperController::class, 'processAssignOrders'])->name('process-assign');
            Route::post('/assign/auto', [ShipperController::class, 'autoAssignOrders'])->name('auto-assign');
            
            // Xem chi tiết shipper
            Route::get('/{shipper}/details', [ShipperController::class, 'showDetails'])->name('details');
        });

        Route::resource('products', ProductController::class);
        Route::resource('attributes', AttributeController::class);
        Route::resource('users', UserController::class);
        Route::resource('promotions', PromotionController::class);
        Route::post('promotions/check-code', [PromotionController::class, 'checkCode'])->name('promotions.check-code');
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
