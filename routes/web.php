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
use App\Http\Controllers\client\MessageController as ClientMessageController;
// Payment Controller
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\MomoController;
use App\Http\Controllers\VnPayController;
// Middleware
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\RedirectIfAuthenticatedCustom;
use App\Http\Middleware\CheckClientLogin;
// Support
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
// Model & Analytics
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

// Shipper App Routes - Đặt TRƯỚC TẤT CẢ để ưu tiên cao nhất
Route::get('/shipper-app', function () {
    return view('shipper-app');
})->name('shipper-app');

Route::get('/shipper-app/{any}', function () {
    return view('shipper-app');
})->where('any', '.*')->name('shipper-app.all');

// Route cho shipper app ở trang chủ
Route::get('/shipper', function () {
    return redirect()->route('shipper-app');
})->name('shipper');

//=================================Admin=================================
require __DIR__ . '/admin.php';
//=================================Admin=================================

// Client Routes home
Route::get('/', [ClientController::class, 'index'])->name('home');

//=================================Online Payment=================================
// checkout vnpay
Route::post('/vnpay-pay', [VnPayController::class, 'pay'])->name('vnpay.payment');
Route::get('/vnpay-return', [VnPayController::class, 'vnpayReturn'])->name('vnpay.return');
// checkout momo
Route::post('/momo/payment', [MomoController::class, 'pay'])->name('momo.payment');
Route::get('/momo/return', [MomoController::class, 'return'])->name('momo.return');
Route::post('/momo/notify', [MomoController::class, 'notify'])->name('momo.notify');
// checkout paypal
Route::controller(PayPalController::class)->group(function () {
    Route::post('/paypal/payment', 'createPayment')->name('paypal.payment');
    Route::get('/paypal/success', 'success')->name('paypal.success');
    Route::get('/paypal/cancel', 'cancel')->name('paypal.cancel');
});
//=================================Online Payment=================================

Route::get('/analytics-test', function () {
    $analyticsData = Analytics::fetchMostVisitedPages(Period::days(7));
    return $analyticsData;
});

//trang cửa hàng
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
// danh sách yêu thích mini (wishlist)
Route::get('/wishlist/mini-list', [WishlistController::class, 'miniList'])->name('wishlist.miniList');
// trang reset password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

//=================================Client=================================
require __DIR__ . '/client.php';
//=================================Client=================================

Route::fallback(function () {
    return response()->view('client.errors.404', [], 404);
});
