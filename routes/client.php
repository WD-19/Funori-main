<?php
//client Controller
use App\Http\Controllers\client\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\client\AboutController;
use App\Http\Controllers\client\Auth\RegisterController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\clientController;
use App\Http\Controllers\client\PageController as ClientPageController;
use App\Http\Controllers\client\ProductController as ClientProductController;
use App\Http\Controllers\client\ContactController as ClientContactCController;
use App\Http\Controllers\client\ProfileController as ProfileController;
use App\Http\Controllers\client\ShopController;
use App\Http\Controllers\client\CheckoutController;
use App\Http\Controllers\client\VoucherController;
use App\Http\Controllers\Client\WishlistController;
use App\Http\Controllers\client\Auth\ForgotPasswordController;
use App\Http\Controllers\client\Auth\ResetPasswordController;
use App\Http\Controllers\Client\MessageController as ClientMessageController;
use App\Http\Controllers\client\OrderController;
// Middleware
use App\Http\Middleware\RedirectIfAuthenticatedCustom;
use App\Http\Middleware\CheckClientLogin;
// Support
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
// Model & Analytics
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

Route::prefix('/')->name('client.')->group(function () {
    Route::get('/dashboard', function () {
        return view('client.index');
    })->name('dashboard');

    // Lấy danh sách tin nhắn (GET)
    Route::get('/messages', [ClientMessageController::class, 'index'])->name('messages.index');
    Route::post('/messages', [ClientMessageController::class, 'store'])->name('messages.store');

    // thêm và xóa sản phẩm trong danh sách yêu thích (wishlist)
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add')->middleware(CheckClientLogin::class);
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove')->middleware(CheckClientLogin::class);

    // đăng ký, đăng nhập và đăng xuất
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index')->middleware(RedirectIfAuthenticatedCustom::class);
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware(RedirectIfAuthenticatedCustom::class);
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // đăng nhập bằng Google
    Route::get('/auth/google', function () {
        return Socialite::driver('google')->redirect();
    })->name('auth.google')->middleware(RedirectIfAuthenticatedCustom::class);
    Route::get('/auth/google/callback', function () {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Chỉ update google_id nếu chưa có
            if (!$user->google_id) {
                $user->update([
                    'google_id' => $googleUser->getId()
                ]);
            }
        } else {
            // Tạo mới nếu chưa có tài khoản
            $user = User::create([
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'full_name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => Hash::make(uniqid()),
            ]);
        }

        Auth::login($user);
        return redirect('/');
    })->name('auth.google.callback')->middleware(RedirectIfAuthenticatedCustom::class);

    // checkout vnpay & momo
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/checkout/prepare', [CheckoutController::class, 'prepareCheckout'])->name('checkout.prepare');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    //trang quên mật khẩu
    Route::get('/forgot-password', [ForgotPasswordController::class, 'show'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'send'])->name('password.email');

    // tin tức, giới thiệu, liên hệ
    Route::get('/page', [ClientPageController::class, 'index'])->name('page');
    Route::get('/page/{slug}', [ClientPageController::class, 'show'])->name('page.show');
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

    // giỏ hàng (Cart)
    Route::get('/cart', [CartController::class, 'cart'])->name('view-cart')->middleware('sync.cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/cart/mini-list', [CartController::class, 'miniCart'])->name('cart.miniList');

    // Thêm lại route mã giảm giá:
    Route::get('/vouchers/applicable', [VoucherController::class, 'getApplicableVouchers'])->name('vouchers.applicable');
    Route::get('/cart/vouchers', [CartController::class, 'getVouchers'])->name('cart.vouchers');
    Route::post('/cart/apply-discount', [CartController::class, 'applyDiscount'])->name('cart.apply-discount');
    Route::post('/cart/remove-discount', [CartController::class, 'removeDiscount'])->name('cart.remove-discount');

    // Checkout (One-Page)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('sync.cart');
    Route::post('/checkout/update-discount', [CheckoutController::class, 'updateDiscount'])->name('checkout.update-discount');

    // Profile (gộp các route trùng lặp và thêm middleware)
    Route::prefix('profile')->name('profile.')->middleware(CheckClientLogin::class)->group(function () {
        Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
        Route::get('/order', [ProfileController::class, 'order'])->name('my_account.order');
        Route::get('/order/detail/{id}', [ProfileController::class, 'detailOrder'])->name('my_account.orderdetail');
        Route::post('/order/{order}/cancel', [ProfileController::class, 'cancelOrder'])->name('my_account.order.cancel');

        // Routes cho hủy đơn hàng với hoàn tiền
        Route::post('/order/{orderId}/cancel-with-refund', [OrderController::class, 'cancelOrder'])->name('order.cancel-with-refund');
        Route::get('/order/{orderId}/refund-info', [OrderController::class, 'getRefundInfo'])->name('order.refund-info');
        Route::get('/order/{orderId}/cancellation-detail', [OrderController::class, 'showCancellationDetail'])->name('order.cancellation-detail');
        Route::get('/refund/{refundId}/status', [OrderController::class, 'checkRefundStatus'])->name('refund.status');

        Route::post('/order/{id}/repeat', [ProfileController::class, 'repeatOrder'])->name('order.repeat');
        Route::get('/voucher', [ProfileController::class, 'vouchers'])->name('voucher');
        Route::get('/refunds', [ProfileController::class, 'refunds'])->name('refunds');
        Route::post('/order/{id}/mark-delivered', [ProfileController::class, 'markDelivered'])->name('order.markDelivered');

        // Order tracking endpoint
        Route::get('/order/{orderId}/tracking', [ProfileController::class, 'getOrderTracking'])->name('order.tracking');

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
        Route::get('/password/edit', [ProfileController::class, 'editPassword'])->name('password.edit');
        Route::post('/password/edit', [ProfileController::class, 'updatePassword'])->name('password.update');
    });

    Route::get('/{slug}', [ClientProductController::class, 'show'])->name('product.show');
});
