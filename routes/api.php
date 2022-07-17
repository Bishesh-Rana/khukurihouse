<?php

use App\Http\Controllers\Api\AdvertisementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Seller\ProductCountController;
use App\Http\Controllers\Api\WebsiteController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\WishListController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\AssignStaffController;
use App\Http\Controllers\Api\AssignDeliveryController;
use App\Http\Controllers\Api\OrderUpdateController;
use App\Http\Controllers\Api\ProductSearchController;
use App\Http\Controllers\Api\TrackOrderController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/product-flash-search', [ProductSearchController::class, 'search'])->name('productSearch');
Route::post('/product-detail-search', [ProductSearchController::class, 'productDetail'])->name('productDetail');

Route::post('/esewa', [CheckoutController::class, 'esewaCheckoutApi']);
Route::post('/khalti', [CheckoutController::class, 'khaltiCheckoutApi']);
Route::post('/verifyStock', [CheckoutController::class, 'verifyStock']);
Route::post('/verifyProduct', [CheckoutController::class, 'verifyProduct']);
Route::post('/paypal', [CheckoutController::class, 'PaypalCheckoutApi']);
Route::post('/getToken', [CheckoutController::class, 'getToken']);
Route::post('/imepay', [CheckoutController::class, 'imePaymentApi']);
Route::post('/cashPayment', [CheckoutController::class, 'cashPaymentApi']);

Route::get('/productcount', [ProductCountController::class, 'productCount']);
Route::post('/deliverycost', [WebsiteController::class, 'deliverycost']);

Route::post('/getDeliveryCharge', [CheckoutController::class, 'getDeliveryCharge'])->name('api.getDeliveryCharge');
Route::post('/getCoupon', [CheckoutController::class, 'getCoupon'])->name('api.getCoupon');

Route::group([
    'prefix' => 'auth', 'namespace' => 'Api'
], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('signup', [LoginController::class, 'register']);
    Route::post('verification', [LoginController::class, 'verification']);
    Route::post('resendOtp', [LoginController::class, 'resendOTP']);


    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', [LoginController::class, 'logout']);
        Route::get('user', [LoginController::class, 'user']);
        Route::get('refresh', [LoginController::class, 'resetToken']);

        Route::get('edit/profile', [DashboardController::class, 'editProfile']);
        Route::post('update/profile', [DashboardController::class, 'updateProfile']);
        Route::post('update/password', [DashboardController::class, 'updatePassword']);
        Route::get('purchase/history', [DashboardController::class, 'purchaseHistory']);
        Route::get('purchase/history/{ref_id}', [DashboardController::class, 'show']);
        Route::get('favouriteList/{seller_id}', [FavouriteController::class, 'favouriteList']);
        Route::get('myFavouriteSeller', [FavouriteController::class, 'myFavouriteSeller']);
        Route::post('image', [DashboardController::class, 'uploadImage']);
        Route::get('referer-list', [DashboardController::class, 'referersList']);
        Route::get('customer-payment-history', [DashboardController::class, 'customerPaymentHistory']);
        Route::get('purchase/toPay', [DashboardController::class, 'toPay']);
    });
});



Route::namespace('Api')->group(function () {

    // After Customer Login API :
    Route::group([
        'middleware' => 'auth:api'
    ], function () {


        // checkout for cash on delivery
        Route::post('cash-checkout', [WebsiteController::class, 'cashCheckout'])->name('api.cash.checkout');
        Route::get('cash-checkout/{ref_id}', [WebsiteController::class, 'completeCashCheckout']);

        // android khalti checkout
        Route::post('/pay-with-khalti', [CheckoutController::class, 'khaltiCheckoutApi']);

        Route::post('khalti/payment/verification', [CheckoutController::class, 'khaltiVerification']);

        //  andriod esewa checkout

        Route::post('esewa-checkout', [CheckoutController::class, 'esewaCheckoutApi']);

        Route::post('esewa/payment/verification', [CheckoutController::class, 'esewaVerification']);


        // ime_pay_recording

        Route::post('pay-with-imepay', [CheckoutController::class, 'imepayCheckoutApi']);

        Route::get('imeVerify/{refId}', [CheckoutController::class, 'imepayVerify']);

        Route::post('pay-with-paypal', [CheckoutController::class, 'paypalCheckoutApi']);
        Route::get('paypalVerify/{refId}', [CheckoutController::class, 'paypalVerify']);

        // Review
        Route::get('reviews', [ReviewController::class, 'reviewList']);  // list of reviews of logged in user only.

        Route::post('add-review', [ReviewController::class, 'addReview']);


        //  product detail with fav status for logged in user
        Route::get('/single-product/{product_slug}', [WishListController::class, 'loginUsershowProduct'])->name('api.product.details.logged.user');

        // add wishlist
        Route::get('wishlist/{product_id}', [WishListController::class, 'wishList']);

        //  wishlist product list of login user
        Route::post('allwishlist-product-list', [WishListController::class, 'productListWishList']);

        //  dashboard
        Route::get('dashboard', [DashboardController::class, 'dashboard']);

        Route::get('order-cancel-list', [DashboardController::class, 'orderCancelList']);

        Route::get('order-pending-list', [DashboardController::class, 'orderPendingList']);

        Route::get('order-return-list', [DashboardController::class, 'orderReturnList']);

        Route::post('change-payment-option', [DashboardController::class, 'paymentOption']);

        Route::get('refer/{referCode}', [WebsiteController::class, 'refer']);

        // Chat API
        Route::get('chat/get-seller-list', [ChatController::class, 'getSellerList']);
        Route::post('/chat/seller', [ChatController::class, 'chatWithSeller']);
        Route::post('/chat/reply', [ChatController::class, 'chatReply']);

        Route::post('order/update', [OrderUpdateController::class, 'orderUpdate']);
        Route::get('order/cancel/{ref_id}', [OrderUpdateController::class, 'cancelOrder']);

        Route::get('toBeReviewed', [ReviewController::class, 'getUnreviewPurchaseProduct']);
    });




    ///////////// To count total notication/////////////////////////////
    Route::get('totalNotification/{customer_id}', [NotificationController::class, 'countNotification']);
    Route::get('allNotification/{customer_id}', [NotificationController::class, 'getAllNotificationByCustomerId']);
    Route::get('notificationDetail/{id}', [NotificationController::class, 'getNotificationDetailById']);

    Route::post('myFavouriteSellerProduct', [FavouriteController::class, 'myFavouriteSellerProduct']);

    Route::post('social-login', [LoginController::class, 'socialLogin']);

    Route::post('before-delivery', [WebsiteController::class, 'deliveryCost']);


    // ime
    Route::post('ime-pay-recording', [CheckoutController::class, 'imepayRecordingApi']);


    Route::get('/', [WebsiteController::class, 'index'])->name('api.home.index');
    Route::get('/product/{product_slug}', [WebsiteController::class, 'showProduct'])->name('api.product.details');
    Route::post('/see-all-product', [WebsiteController::class, 'seeAllProduct'])->name('api.seeall.product');

    Route::get('/see-all-featured-category', [WebsiteController::class, 'seeAllFeaturedCategory'])->name('api.seeall.featured.category');
    Route::post('/see-all-featured-product', [WebsiteController::class, 'seeAllFeaturedProduct'])->name('api.seeall.featured.product');
    Route::get('/see-all-popular-category', [WebsiteController::class, 'seeAllPopularCategory'])->name('api.seeall.popular.category');
    Route::get('/filter-data', [WebsiteController::class, 'filterData']);

    //track Order
    Route::post('/track-order', [TrackOrderController::class,'trackOrder'])->middleware('auth:api');


    // sub category detail
    Route::post('/subcat/{category_slug}', [WebsiteController::class, 'getSubCat_Product'])->name('api.test');

    //  stock Verify
    Route::post('/stock-verify/', [WebsiteController::class, 'stockVerify'])->name('api.stock.verify');

    //before - checkout api
    Route::post('before-checkout', [WebsiteController::class, 'beforeCheckout'])->name('api.checkout');

    Route::post('different-shipping', [WebsiteController::class, 'differentShipping'])->name('different.shipping');

    // coupon api
    Route::post('coupon', [WebsiteController::class, 'coupon'])->name('api.coupon');
    Route::get('couponList', [WebsiteController::class, 'couponList'])->name('api.coupon.list');
    Route::get('/displayCoupon', [WebsiteController::class, 'displayCoupon']);

    // search
    Route::post('search', [WebsiteController::class, 'search']);
    Route::post('image-search', [WebsiteController::class, 'searchByImage']);

    // news list
    Route::get('news', [WebsiteController::class, 'newsList'])->name('api.news.list');

    // news detail
    Route::get('news/{news_url}', [WebsiteController::class, 'newsDetail'])->name('api.news.detail');

    // ads list
    Route::get('advertisement', [WebsiteController::class, 'adsList'])->name('api.ads.list');
    Route::get('home-ad', [AdvertisementController::class, 'getAdvertisement']);

    // single product all  reviews
    Route::get('single-products-reviews/{product_id}', [ReviewController::class, 'productReview']);

    // Compare
    Route::post('compare', [WebsiteController::class, 'compare']);

    Route::get('help-and-support', [WebsiteController::class, 'helpAndSupport']);

    Route::post('feedback', [WebsiteController::class, 'feedback']);


    //
    Route::get('sidebar-category', [WebsiteController::class, 'sidebarCategory']);
    Route::post('sub-category', [WebsiteController::class, 'sidebarSubCategory']);
    // Route::get('sidebar-category/{category_slug}',[WebsiteController::class, 'sidebarSubCat']);

    //Forget Password Route
    Route::post('forget-password', [ForgotPasswordController::class, 'getForgetEmail']);
    // Route::post('verify-otp',[ForgotPasswordController::class,'verifyOTP']);
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword']);
});

Route::namespace('Api')->group(function () {
    Route::group([
        'middleware' => 'auth:admin'
    ], function () {

        Route::post('delivery-assign', [AssignDeliveryController::class, 'deliveryAssign'])->name('delivery.assign.store');
    });
});

Route::namespace('Api')->group(function () {
    Route::group([
        'middleware' => 'auth:delivery'
    ], function () {

        Route::post('staff-assign', [AssignStaffController::class, 'staffAssign'])->name('staff.delivery.assign');
    });
});
