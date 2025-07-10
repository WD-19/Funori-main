<?php
//Admin Controller
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ShippingMethodController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\AboutController;
//Client Controller
use App\Http\Controllers\Client\Auth\LoginController;
use App\Http\Controllers\Client\Auth\RegisterController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\client\PageController as ClientPageController;
use App\Http\Controllers\client\ProductController as ClientProductController;
use App\Http\Controllers\client\ContactController as ClientContactCController;
use App\Http\Controllers\client\ProfileController as ProfileController;
use App\Http\Controllers\client\ShopController;
use App\Http\Controllers\client\CheckoutController;
use App\Http\Controllers\client\WishlistController;
use App\Http\Middleware\CheckClientLogin;
// Middleware
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
    return redirect()->route('client.home');
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
        // (7) Xử lý yêu cầu hủy đơn (khách hàng đã gửi "request cancel"), admin duyệt/không duyệt
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

Route::get('/', [ClientController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::prefix('/')->name('client.')->group(function () {
    Route::get('/dashboard', function () {
        return view('client.index');
    })->name('dashboard');

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/page', [ClientPageController::class, 'index'])->name('page');
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    Route::get('/contact', [ClientContactCController::class, 'index'])->name('contact');
    Route::post('/contactForm', [ClientContactCController::class, 'store'])->name('contact.store');

    Route::get('/search', [ClientProductController::class, 'search'])->name('search');

    //nếu /client thì trả về view 404
    Route::get('/client', function () {
        return response()->view('client.errors.404', [], 404);
    });

    Route::post('/product/{product}/review', [ClientProductController::class, 'store'])
        ->middleware(CheckClientLogin::class)
        ->name('reviews.store');

    // Route giỏ hàng (Cart)
    Route::get('/cart', [CartController::class, 'cart'])->name('view-cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    // Đảm bảo route này là POST, vì JS gọi POST /cart/remove
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    // JS gọi POST nên route phải là POST
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

    // Wishlist
    Route::prefix('wishlist')->name('wishlist.')->middleware(CheckClientLogin::class)->group(function () {
        Route::post('/add', [WishlistController::class, 'add'])->name('add');
        Route::post('/remove', [WishlistController::class, 'remove'])->name('remove');
        Route::get('/mini-list', [WishlistController::class, 'miniList'])->name('miniList');
    });

    // Checkout (One-Page)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    // Profile (gộp các route trùng lặp và thêm middleware)
    Route::prefix('profile')->name('profile.')->middleware(CheckClientLogin::class)->group(function () {
        Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
        Route::get('/order', [ProfileController::class, 'order'])->name('order');

        // Address Management
        Route::prefix('address')->name('address.')->group(function () {
            Route::get('/', [ProfileController::class, 'address'])->name('index');
            Route::post('/', [ProfileController::class, 'storeAddress'])->name('store');
            Route::get('/{address}/edit', [ProfileController::class, 'editAddress'])->name('edit');
            Route::post('/{address}/update', [ProfileController::class, 'updateAddress'])->name('update');
            Route::delete('/{address}', [ProfileController::class, 'destroyAddress'])->name('destroy');
            Route::post('/{address}/set-default', [ProfileController::class, 'setDefaultAddress'])->name('setDefault');
        });

        Route::get('/account', [ProfileController::class, 'account'])->name('account');
        Route::post('/account', [ProfileController::class, 'updateAccount'])->name('account.update');
        Route::get('/wishlist', [ProfileController::class, 'wishlist'])->name('wishlist');
    });

    // Route chi tiết sản phẩm (để cuối cùng để không bắt các route khác)
    Route::get('/{slug}', [ClientProductController::class, 'show'])->name('product.show');
});

// Fallback cho các route không tồn tại
Route::fallback(function () {
    return response()->view('client.errors.404', [], 404);
});