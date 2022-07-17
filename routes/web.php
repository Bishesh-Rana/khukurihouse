<?php

use App\Http\Controllers\Admin\AdminAssociateFinanceController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminFinanceController;
use App\Http\Controllers\Admin\AdminSalesReturnController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DelieverSettingController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\ManageProductImageController;
use App\Http\Controllers\Admin\MeasureController;
use App\Http\Controllers\Admin\News\NewsCategoryController;
use App\Http\Controllers\Admin\News\WriterController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderUpdateController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PushNotificationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleToPermissionController;
// use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Affiliate\Auth\AffiliateLoginController;
use App\Http\Controllers\Affiliate\Auth\ForgotPasswordController as AffiliateAuthForgotPasswordController;
use App\Http\Controllers\Affiliate\Auth\ResetPasswordController as AffiliateAuthResetPasswordController;
use App\Http\Controllers\Affiliate\DashboardController as AffiliateDashboardController;
use App\Http\Controllers\Affiliate\FinanceController as AffiliateFinanceController;
use App\Http\Controllers\Affiliate\ProductController as AffiliateProductController;
use App\Http\Controllers\Affiliate\ProfileController as AffiliateProfileController;
use App\Http\Controllers\AffiliateRegisterController;
use App\Http\Controllers\AjaxCartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\Customer\Auth\CustomerLoginController;
use App\Http\Controllers\Customer\Auth\CustomerRegisterController;
use App\Http\Controllers\Customer\Auth\ForgotPasswordController as CustomerAuthForgotPasswordController;
use App\Http\Controllers\Customer\Auth\ResetPasswordController as CustomerAuthResetPasswordController;
use App\Http\Controllers\Customer\CustomerChatController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Delivery\Auth\DeliveryLoginController;
use App\Http\Controllers\Delivery\Auth\ForgotPasswordController as DeliveryAuthForgotPasswordController;
use App\Http\Controllers\Delivery\Auth\ResetPasswordController as DeliveryAuthResetPasswordController;
use App\Http\Controllers\Delivery\DashboardController as DeliveryDashboardController;
use App\Http\Controllers\Delivery\DeliveryController as DeliveryDeliveryController;
use App\Http\Controllers\Delivery\DeliveryDeliverySettingController;
use App\Http\Controllers\Delivery\DeliverySalesReturnController;
use App\Http\Controllers\Delivery\OrderController as DeliveryOrderController;
use App\Http\Controllers\Delivery\ProfileController as DeliveryProfileController;
use App\Http\Controllers\Delivery\StaffController as DeliveryStaffController;
use App\Http\Controllers\Delivery\StaffProfileController as DeliveryStaffProfileController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderUpdateController as ControllersOrderUpdateController;
// use App\Http\Controllers\SellerRegisterController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DeliveryServiceAreaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/ns-admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');


    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    //////////////////////////////////////Admin Forget Password////////////////////////////
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');


    Route::get('/admins', [AdminController::class, 'index'])->middleware('permission:browse_admin');
    Route::get('/admins/create', [AdminController::class, 'create'])->middleware('permission:create_admin');
    Route::post('/admins/add', [AdminController::class, 'store']);
    Route::get('/admins/edit/{admin}', [AdminController::class, 'edit'])->middleware('permission:update_admin');
    Route::post('/admins/edit/{admin}', [AdminController::class, 'update']);
    Route::get('/admins/delete/{admin}', [AdminController::class, 'destroy'])->middleware('permission:delete_admin');

    Route::get('deliveryServiceArea',[DeliveryServiceAreaController::class,'index'])->name('deliveryServiceArea.index');
    Route::get('deliveryServiceArea/create',[DeliveryServiceAreaController::class,'create'])->name('deliveryServiceArea.create');
    Route::post('deliveryServiceArea',[DeliveryServiceAreaController::class,'store'])->name('deliveryServiceArea.store');
    Route::get('deliveryServiceArea/edit/{id}',[DeliveryServiceAreaController::class,'edit'])->name('deliveryServiceArea.edit');
    Route::post('deliveryServiceArea/update/{id}',[DeliveryServiceAreaController::class,'update'])->name('deliveryServiceArea.update');
    Route::post('deliveryServiceArea/all/fetch', [DeliveryServiceAreaController::class, 'allDelieverServiceAreaFetch'])->name('admin.ajax.deliveryServiceArea.list');

    //////////////////////////Seller Registration///////////////////////////
    // Route::get('/sellers', [SellerController::class, 'index'])->name('seller.list')->middleware('permission:browse_seller');
    // Route::get('/sellers/create', [SellerController::class, 'create'])->name('seller.create')->middleware('permission:create_seller');
    // Route::post('/sellers/add', [SellerController::class, 'store'])->name('seller.add');
    // Route::get('/sellers/edit/{seller}', [SellerController::class, 'edit'])->name('seller.edit')->middleware('permission:update_seller');
    // Route::post('/sellers/edit/{seller}', [SellerController::class, 'update'])->name('seller.update');
    // Route::get('/sellers/delete/{seller}', [SellerController::class, 'destroy'])->name('seller.delete')->middleware('permission:delete_seller');
    // Route::post('/seller/image', [SellerController::class, 'AjaxImageUpload'])->name('sellerimage');
    // Route::get('sellers/all/fetch', [SellerController::class, 'allSellerFetch'])->name('admin.ajax.seller.list');

    // Route::get('seller-view/order-history/{id}', [SellerController::class, 'viewSellerOrderList'])->name('admin.seller.order-history');
    // Route::get('seller/order-history/fetch', [SellerController::class, 'fetchSellerOrderList'])->name('admin.fetch.seller.order-history');
    // Route::get('seller-view/cancel-history/{id}', [SellerController::class, 'viewSellerCancelList'])->name('admin.seller.cancel-history');
    // Route::get('seller/cancel-history/fetch', [SellerController::class, 'fetchSellerCancelList'])->name('admin.fetch.seller.cancel-history');

    //////////////////////////Delivery Registration///////////////////////////
    // Route::get('/deliveries', 'DeliveryController@index')->name('delivery.list')->middleware('permission:browse_delivery');
    // Route::get('/deliveries/create', 'DeliveryController@create')->name('delivery.create')->middleware('permission:create_delivery');
    // Route::post('/deliveries/add', 'DeliveryController@store')->name('delivery.add');
    // Route::get('/deliveries/edit/{delivery}', 'DeliveryController@edit')->name('delivery.edit')->middleware('permission:update_delivery');
    // Route::post('/deliveries/edit/{delivery}', 'DeliveryController@update')->name('delivery.update');
    // Route::get('/deliveries/delete/{delivery}', 'DeliveryController@destroy')->name('delivery.delete')->middleware('permission:delete_delivery');
    // Route::post('/delivery/image', 'DeliveryController@AjaxImageUpload')->name('deliveryimage');

    //////////////////////////Delivery Registration///////////////////////////
    Route::get('/deliveries', [DeliveryController::class, 'index'])->name('delivery.list')->middleware('permission:browse_delivery');
    Route::get('/deliveries/create', [DeliveryController::class, 'create'])->name('delivery.create')->middleware('permission:create_delivery');
    Route::post('/deliveries/add', [DeliveryController::class, 'store'])->name('delivery.add');
    Route::get('/deliveries/edit/{delivery}', [DeliveryController::class, 'edit'])->name('delivery.edit')->middleware('permission:update_delivery');
    Route::post('/deliveries/edit/{delivery}', [DeliveryController::class, 'update'])->name('delivery.update');
    Route::get('/deliveries/delete/{delivery}', [DeliveryController::class, 'destroy'])->name('delivery.delete')->middleware('permission:delete_delivery');
    Route::post('/delivery/image', [DeliveryController::class, 'AjaxImageUpload'])->name('delivery.image');

    //////////////////////////Affiliate List///////////////////////////
    Route::get('/affiliates', [AffiliateController::class, 'index'])->name('affiliate.list')->middleware('permission:browse_affiliate');
    Route::get('/affiliates/edit/{affiliate}', [AffiliateController::class, 'edit'])->name('affiliate.edit');
    Route::post('/affiliates/edit/{affiliate}', [AffiliateController::class, 'update'])->name('affiliate.update');
    Route::get('/affiliates/fetch', [AffiliateController::class, 'fetch'])->name('admin.ajax.affiliate.list');
    Route::post('/affiliates/update', [AffiliateController::class, 'update'])->name('affiliate.update');
    Route::post('/affiliates/update/commission', [AffiliateController::class, 'updateCommission'])->name('affiliate.update.commission');

    Route::get('affiliate-view/order-history/{id}', [AffiliateController::class, 'viewAffiliateOrderList'])->name('admin.affiliate.order-history');
    Route::get('affiliate/order-history/fetch', [AffiliateController::class, 'fetchAffiliateOrderList'])->name('admin.fetch.affiliate.order-history');
    Route::get('affiliate-view/cancel-history/{id}', [AffiliateController::class, 'viewAffiliateCancelList'])->name('admin.affiliate.cancel-history');
    Route::get('affiliate/cancel-history/fetch', [AffiliateController::class, 'fetchAffiliateCancelList'])->name('admin.fetch.affiliate.cancel-history');

    /*
    |----------------------------------------------------------
    | Customer List Display
    |----------------------------------------------------------
    */
    Route::get('customer-list', [CustomerController::class, 'index'])->name('admin.customer.list')->middleware('permission:browse_customer');
    Route::get('customer-block/{customer_username}', [CustomerController::class, 'customerBlock'])->name('admin.customer.block');
    Route::get('ajax-customer-list', [CustomerController::class, 'ajaxFetchCustomerList'])->name('ajax.customer.list');
    Route::get('customer-view/{id}', [CustomerController::class, 'viewCustomerPurchaseList'])->name('admin.customer.purchase-history');
    Route::get('customer/purchase-history/fetch', [CustomerController::class, 'fetchCustomerPurchaseList'])->name('admin.fetch.customer.purchase-history');
    Route::get('customer-view/cancel-order/{id}', [CustomerController::class, 'viewCustomerCancelList'])->name('admin.customer.cancel-history');
    Route::get('customer/cancel-history/fetch', [CustomerController::class, 'fetchCustomerCancelList'])->name('admin.fetch.customer.cancel-history');

    Route::get('roles', [RoleController::class, 'index'])->middleware('permission:browse_role');
    Route::get('roles/create', [RoleController::class, 'create'])->middleware('permission:create_role');
    Route::post('roles/add', [RoleController::class, 'store']);
    Route::get('roles/edit/{role}', [RoleController::class, 'edit'])->middleware('permission:update_role');
    Route::post('roles/edit/{role}', [RoleController::class, 'update']);
    Route::get('roles/delete/{role}', [RoleController::class, 'destroy'])->middleware('permission:delete_role');

    Route::get('rolepermissions', [RoleToPermissionController::class, 'index']);
    Route::get('rolepermissions/create', [RoleToPermissionController::class, 'create']);
    Route::post('rolepermissions/add', [RoleToPermissionController::class, 'store']);
    Route::get('rolepermissions/edit/{role}', [RoleToPermissionController::class, 'edit']);
    Route::post('rolepermissions/edit/{role}', [RoleToPermissionController::class, 'update']);
    Route::get('rolepermissions/delete/{role}', [RoleToPermissionController::class, 'destroy']);

    //------------------Categories Route------------------//
    Route::get('categories', [CategoryController::class, 'index'])->name('category.list')->middleware('permission:browse_category');
    Route::get('categories/list', [CategoryController::class, 'list'])->name('category.lists')->middleware('permission:browse_category');
    Route::get('categories/fetch', [CategoryController::class, 'fetch'])->name('admin.category.ajaxfetch')->middleware('permission:browse_category');
    Route::get('categories/create', [CategoryController::class, 'create'])->middleware('permission:create_category');
    Route::post('categories/add', [CategoryController::class, 'store']);
    Route::get('categories/view/{category}', [CategoryController::class, 'view']);
    Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->middleware('permission:update_category');
    Route::post('categories/edit/{category}', [CategoryController::class, 'update']);
    Route::get('categories/delete/{category}', [CategoryController::class, 'destroy'])->middleware('permission:delete_category');
    Route::get('categories/removeImage/{category}', [CategoryController::class, 'removeImage']);
    Route::get('categories/removeBanner/{category}', [CategoryController::class, 'removeBanner']);
    Route::post('/categories/image', [CategoryController::class, 'AjaxImageUpload'])->name('category.image');
    Route::post('/categories/postlist', [CategoryController::class, 'postlist'])->name('category.postlist')->middleware('permission::browse_category');
    Route::post('categories/orderupdate', [CategoryController::class, 'updateOrder'])->name('updateOrderCategory');


    /*
    |----------------------------------------------------------
    |Product Management
    |----------------------------------------------------------
    */
    Route::get('/products', [ProductController::class, 'index'])->name('product.index')->middleware('permission:browse_product');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create')->middleware('permission:create_product');
    Route::post('/products/add', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('product.edit')->middleware('permission:update_product');
    Route::get('/products/view/{product}', [ProductController::class, 'view'])->name('product.view');
    Route::post('/products/edit/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/products/delete/{product}', [ProductController::class, 'destroy'])->middleware('permission:delete_product');
    Route::get('products/all/fetch', [ProductController::class, 'allProductFetch'])->name('admin.ajax.product');
    Route::get('products/deleteSingeImage', [ProductController::class, 'deleteSingeImage'])->name('admin.deleteSingeImage');

    /*
    |----------------------------------------------------------
    | Manage Product Image  Management
    |----------------------------------------------------------
    */
    Route::get('/product/manage-images', [ManageProductImageController::class, 'manageProductImagesList'])->name('admin.product.manageproduct.image.list');
    Route::post('/manage/product/image', [ManageProductImageController::class, 'AjaxImageUpload'])->name('admin.manage.productimage');
    Route::get('/products/single/manage/image/delete/{product}', [ManageProductImageController::class, 'singleImgDestroy'])->name('admin.product.manage.img.delete');

    /*
    |----------------------------------------------------------
    | Manage Product Image  Management
    |----------------------------------------------------------
    */

    Route::resource('flash-sale', FlashSaleController::class);



    /*
    |----------------------------------------------------------
    | Notification
    |----------------------------------------------------------
    */
    Route::get('notify/{product_id}', [ProductController::class, 'notificationUpdated'])->name('admin.notification.update');

    //------------------Stocks Route------------------//
    Route::get('/stocks', [StockController::class, 'index'])->name('admin.stock.list')->middleware('permission:browse_product');
    Route::get('stocks/fetch', [StockController::class, 'fetch'])->name('admin.stock.ajaxfetch')->middleware('permission:browse_product');
    Route::get('/stocks/view/{stock}', [StockController::class, 'view'])->middleware('permission:browse_product');
    Route::get('/stocks/edit/{stock}', [StockController::class, 'edit'])->name('admin.stock.edit')->middleware('permission:browse_product');
    Route::post('/stocks/edit/{stock}', [StockController::class, 'update'])->middleware('permission:browse_product');
    Route::get('/decreaseByOne/{id}', [StockController::class, 'decreaseByOne'])->name('stock.decreaseByOne')->middleware('permission:browse_product');
    Route::get('/increaseByOne/{id}', [StockController::class, 'increaseByOne'])->name('stock.increaseByOne')->middleware('permission:browse_product');


    /*
    |----------------------------------------------------------
    |Admin Order Management
    |----------------------------------------------------------
    */
    Route::get('/admin/ready-shipping/{ref_id}', [OrderController::class, 'updateReadyShipping'])->name('admin.order.shipping');
    Route::get('/admin/shipped/{ref_id}', [OrderController::class, 'updateShipped'])->name('admin.order.shipped');
    Route::get('/admin/delivered/{ref_id}', [OrderController::class, 'updateDelivered'])->name('admin.order.delivered');

    /*
    |----------------------------------------------------------
    |All Order Management
    |----------------------------------------------------------
    */
    Route::get('list-seller-order', [OrderController::class, 'sellerOrderList'])->name('admin.list.seller.order');
    Route::get('list-seller-order-fetch', [OrderController::class, 'fetch'])->name('admin.list.seller.order.fetch');

    //  order list routes of order boxes
    Route::get('list-admin-order', [OrderController::class, 'adminOrderList'])->name('admin.list.admin.order'); // pending list
    Route::get('list-admin-order-fetch', [OrderController::class, 'ajaxAdminOrderFetch'])->name('admin.list.admin.order.fetch');

    Route::get('/cancel-orders/{ref_id}', [OrderController::class, 'cancelOrder'])->name('admin.order.cancel');
    Route::get('/ready-shipping', [OrderController::class, 'listReadyShipping'])->name('admin.order.ready.shipping.list'); // ready to ship list
    Route::get('/ready-shipping-fetch', [OrderController::class, 'ajaxListReadyShippingFetch'])->name('ajax.admin.order.ready.shipping.list.fetch'); // ready to ship list

    Route::get('/shipped', [OrderController::class, 'listShipped'])->name('admin.order.shipped.list'); // shipped list
    Route::get('/shipped-fetch', [OrderController::class, 'ajaxListShippedFetch'])->name('ajax.admin.order.shipped.list.fetch'); // shipped list

    Route::get('/delivered-shipping', [OrderController::class, 'listDelivered'])->name('admin.order.delivered.list'); // delivered list
    Route::get('/delivered-shipping-fetch', [OrderController::class, 'ajaxListDeliveredFetch'])->name('ajax.admin.order.delivered.list.fetch'); // delivered list

    Route::get('/list-cancel-delivery', [OrderController::class, 'listCancelledOrder'])->name('admin.order.cancel.list'); // cancelled list
    Route::get('/order-cancel-fetch', [OrderController::class, 'ajaxListCancelledOrderFetch'])->name('admin.ajax.ordercancel.fetch');

    // Order views of every module.
    Route::get('/view-pending-orders/{ref_id}', [OrderController::class, 'viewOrder'])->name('admin.order.detail');
    Route::get('/view-ready-shipping/{ref_id}', [OrderController::class, 'viewReadyShipping'])->name('admin.order.ready.shipping.view');
    Route::get('/view-shipped/{ref_id}', [OrderController::class, 'viewShipped'])->name('admin.order.shipped.view');


    Route::get('send-mail-ship-notification/{seller_id}/{ref_id}', [OrderController::class, 'sendMail'])->name('send.mail.ship.notification');

    //------------------Coupons Route------------------//
    Route::get('coupons', [CouponController::class, 'index'])->name('admin.coupon.index')->middleware('permission:browse_coupon');
    Route::get('coupons/create', [CouponController::class, 'create'])->name('admin.coupon.create')->middleware('permission:create_coupon');
    Route::post('coupons/add', [CouponController::class, 'store'])->name('admin.coupon.store');
    Route::get('coupons/edit/{coupon}', [CouponController::class, 'edit'])->name('admin.coupon.edit')->middleware('permission:update_coupon');
    Route::post('coupons/edit/{coupon}', [CouponController::class, 'update'])->name('admin.coupon.update');
    Route::get('coupons/delete/{coupon}', [CouponController::class, 'destroy'])->name('admin.coupon.destroy')->middleware('permission:delete_coupon');
    Route::get('admin-view-order/{ref_id}', [OrderController::class, 'viewOrder'])->name('admin.list.view.order');


    //------------------Settings Route------------------//
    Route::get('settings', [SettingController::class, 'create'])->middleware('permission:create_setting');
    Route::post('settings/add', [SettingController::class, 'store']);
    Route::post('settings/edit/{setting}', [SettingController::class, 'update'])->middleware('permission:update_setting');

    //------------------Ajax Image Upload Route------------------//
    Route::post('/product/image', [ProductController::class, 'AjaxImageUpload'])->name('productimage');
    Route::post('/settings/image', [SettingController::class, 'AjaxImageUpload']);
    Route::post('/news-cat/image', [NewsCategoryController::class, 'AjaxImageUpload']);
    Route::post('/news/image', [NewsController::class, 'AjaxImageUpload'])->name('news.image');
    Route::post('/writer/image', [WriterController::class, 'AjaxImageUpload']);
    Route::post('/slider/image', [SliderController::class, 'AjaxImageUpload']);
    Route::post('/pushnotification/image', [PushNotificationController::class, 'AjaxImageUpload']);
    Route::post('/content/image', [ContentController::class, 'AjaxImageUpload'])->name('content.image');
    Route::post('/notice/image', [AdvertisementController::class, 'AjaxImageUpload'])->name('advertisement.image');
    Route::post('/brand/image', [BrandController::class, 'AjaxImageUpload'])->name('brand.image');

    Route::post('/product/getsubcategory', [ProductController::class, 'AjaxGetSubCategory'])->name('getsubcategory');
    Route::post('/product/getchildcategory', [ProductController::class, 'AjaxGetChildCategory'])->name('getchildcategory');

    // ------------------News Categories Route------------------//
    Route::get('newsCategories', [NewsCategoryController::class, 'index'])->name('newscategory.list')->middleware('permission:browse_news_category');
    Route::get('newsCategories/create', [NewsCategoryController::class, 'create'])->middleware('permission:create_news_category');
    Route::post('newsCategories/add', [NewsCategoryController::class, 'store']);
    Route::get('newsCategories/edit/{category}', [NewsCategoryController::class, 'edit'])->middleware('permission:update_news_category');
    Route::post('newsCategories/edit/{category}', [NewsCategoryController::class, 'update']);
    Route::get('newsCategories/delete/{category}', [NewsCategoryController::class, 'destroy'])->middleware('permission:delete_news_category');
    Route::get('newsCategories/removeFeature/{category}', [NewsCategoryController::class, 'removeFeature']);
    Route::get('newsCategories/removeParallex/{category}', [NewsCategoryController::class, 'removeParallex']);

    // ------------------News Tags Route------------------//
    Route::get('tags', [TagController::class, 'index'])->name('tags.list');
    Route::get('tags/create', [TagController::class, 'create']);
    Route::post('tags/add', [TagController::class, 'store']);
    Route::get('tags/edit/{tag}', [TagController::class, 'edit']);
    Route::post('tags/edit/{tag}', [TagController::class, 'update']);
    Route::get('tags/delete/{tag}', [TagController::class, 'destroy']);

    //------------------News Route------------------//
    Route::get('news', [NewsController::class, 'index'])->name('news.list')->middleware('permission:browse_news');
    Route::get('news/create', [NewsController::class, 'create'])->middleware('permission:create_news');
    Route::post('news/add', [NewsController::class, 'store']);
    Route::get('news/edit/{news}', [NewsController::class, 'edit'])->middleware('permission:update_news');
    Route::post('news/edit/{news}', [NewsController::class, 'update']);
    Route::get('news/delete/{news}', [NewsController::class, 'destroy'])->middleware('permission:delete_news');
    Route::get('news/removeFeature/{news}', [NewsController::class, 'removeFeature']);
    Route::get('news/removeParallex/{news}', [NewsController::class, 'removeParallex']);

    //------------------Writer Route------------------//
    Route::get('writers', [WriterController::class, 'index'])->name('writter.list');
    Route::get('writers/create', [WriterController::class, 'create']);
    Route::post('writers/add', [WriterController::class, 'store']);
    Route::get('writers/edit/{writer}', [WriterController::class, 'edit']);
    Route::post('writers/edit/{writer}', [WriterController::class, 'update']);
    Route::get('writers/delete/{writer}', [WriterController::class, 'destroy']);
    Route::get('writers/removeFeature/{writer}', [WriterController::class, 'removeFeature']);

    //------------------Content Route------------------//
    Route::get('contents', [ContentController::class, 'index'])->middleware('permission:browse_content');
    Route::get('contents/create', [ContentController::class, 'create'])->middleware('permission:create_content');
    Route::post('contents/add', [ContentController::class, 'store']);
    Route::get('contents/edit/{content}', [ContentController::class, 'edit'])->middleware('permission:update_content');
    Route::post('contents/edit/{content}', [ContentController::class, 'update']);
    Route::get('contents/delete/{content}', [ContentController::class, 'destroy'])->middleware('permission:delete_content');
    Route::get('contents/removeFeature/{content}', [ContentController::class, 'removeFeature']);
    Route::post('contents/orderupdate', [ContentController::class, 'updateOrder'])->name('updateOrderContents');


    //------------------Sliders Route------------------//
    Route::get('sliders', [SliderController::class, 'index'])->name('slider.list')->middleware('permission:browse_slider');
    Route::get('sliders/fetch', [SliderController::class, 'fetch'])->name('admin.slider.ajaxfetch')->middleware('permission:browse_slider');
    Route::get('sliders/create', [SliderController::class, 'create'])->middleware('permission:create_slider');
    Route::post('sliders/add', [SliderController::class, 'store']);
    Route::get('sliders/edit/{slider}', [SliderController::class, 'edit'])->middleware('permission:update_slider');
    Route::post('sliders/edit/{slider}', [SliderController::class, 'update']);
    Route::get('sliders/delete/{slider}', [SliderController::class, 'destroy'])->middleware('permission:delete_slider');
    Route::get('ajax/sliders/delete', [SliderController::class, 'ajaxSliderImgDestroy'])->name('admin.slider.img.delete')->middleware('permission:delete_slider');

    //------------------Push notification Route------------------//
    Route::get('pushnotifications', [PushNotificationController::class, 'index'])->name('notification.list')->middleware('permission:browse_push_notification');
    Route::get('pushnotifications/fetch', [PushNotificationController::class, 'fetch'])->name('admin.pushnotification.ajaxfetch');
    Route::get('pushnotifications/create', [PushNotificationController::class, 'create'])->middleware('permission:create_push_notification');
    Route::post('pushnotifications/add', [PushNotificationController::class, 'store']);
    Route::get('pushnotifications/edit/{notification}', [PushNotificationController::class, 'edit'])->middleware('permission:update_push_notification');
    Route::post('pushnotifications/edit/{notification}', [PushNotificationController::class, 'update']);
    Route::get('pushnotifications/delete/{notification}', [PushNotificationController::class, 'destroy'])->middleware('permission:delete_push_notification');
    Route::get('pushnotifications/send/{notification}', [PushNotificationController::class, 'send']);
    // Route::get('pushnotifications/send/{notification}', [PushNotificationController::class,'send']);

    //------------------Advertisements Route------------------//
    Route::get('advertisements', [AdvertisementController::class, 'index'])->middleware('permission:browse_advertisement');
    Route::get('advertisements/create', [AdvertisementController::class, 'create'])->middleware('permission:create_advertisement');
    Route::post('advertisements/add', [AdvertisementController::class, 'store']);
    Route::get('advertisements/edit/{ad}', [AdvertisementController::class, 'edit'])->middleware('permission:update_advertisement');
    Route::post('advertisements/edit/{ad}', [AdvertisementController::class, 'update']);
    Route::get('advertisements/delete/{ad}', [AdvertisementController::class, 'destroy'])->middleware('permission:delete_advertisement');
    Route::get('advertisements/removeImage/{ad}', [AdvertisementController::class, 'removeImage']);
    Route::get('advertisements/mail/{ad}', [AdvertisementController::class, 'mailtosubscribers'])->name('mailtosubscribers');

    //------------------Brands Route------------------//
    Route::get('brands', [BrandController::class, 'index'])->middleware('permission:browse_brand');
    Route::get('brands/create', [BrandController::class, 'create'])->middleware('permission:create_brand');
    Route::post('brands/add', [BrandController::class, 'store']);
    Route::get('brands/edit/{brand}', [BrandController::class, 'edit'])->middleware('permission:update_brand');
    Route::post('brands/edit/{brand}', [BrandController::class, 'update']);
    Route::get('brands/delete/{brand}', [BrandController::class, 'destroy'])->middleware('permission:delete_brand');
    Route::get('brands/removeImage/{brand}', [BrandController::class, 'removeImage']);

    //------------------Contacts Route------------------//
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/view/{contact}', [ContactController::class, 'view']);
    Route::get('contacts/delete/{contact}', [ContactController::class, 'delete']);

    //------------------Subscribers Route------------------//
    Route::get('subscribers', [SubscriberController::class, 'index']);
    Route::get('subscribers/delete/{subscriber}', [SubscriberController::class, 'delete']);


    //------------------Sliders Route------------------//
    Route::get('measures', [MeasureController::class, 'index'])->name('measure.list');
    Route::get('measures/fetch', [MeasureController::class, 'fetch'])->name('admin.measure.ajaxfetch');
    Route::get('measures/create', [MeasureController::class, 'create']);
    Route::post('measures/add', [MeasureController::class, 'store']);
    Route::get('measures/edit/{slider}', [MeasureController::class, 'edit']);
    Route::post('measures/edit/{slider}', [MeasureController::class, 'update']);
    Route::get('measures/delete/{slider}', [MeasureController::class, 'destroy']);

    /*
        |----------------------------------------------------------
        | Deliever Setting Management
        |----------------------------------------------------------
        */
    Route::get('deliever-list', [DelieverSettingController::class, 'index'])->name('admin.deliever_setting.list')->middleware('permission:browse_delivery_setting');
    Route::get('deliever/create', [DelieverSettingController::class, 'create'])->name('admin.deliever_setting.create')->middleware('permission:create_delivery_setting');
    Route::get('deliever/edit/{id}', [DelieverSettingController::class, 'edit'])->name('admin.deliever_setting.edit')->middleware('permission:update_delivery_setting');
    Route::post('deliever/update/{id}', [DelieverSettingController::class, 'update'])->name('admin.deliever_setting.update');
    Route::post('deliever/add', [DelieverSettingController::class, 'store'])->name('admin.deliever_setting.add');
    Route::get('deliever/all/fetch', [DelieverSettingController::class, 'allDelieverSettingFetch'])->name('admin.ajax.deliever_setting.list');



    /*
        |----------------------------------------------------------
        |Order Update Management
        |----------------------------------------------------------
        */
    Route::get('update-order-list', [OrderUpdateController::class, 'updateOrderList'])->name('admin.update.order.list');
    Route::get('cancelled-order-list', [OrderUpdateController::class, 'cancelledOrderList'])->name('admin.cancelled.order.list');

    /*
        |----------------------------------------------------------
        |Sales Return Management
        |----------------------------------------------------------
        */
    Route::get('sales-return', [AdminSalesReturnController::class, 'index'])->name('admin.sales.return.index')->middleware('permission:browse_sales_return');
    Route::get('sales-return/edit/{sales_return}', [AdminSalesReturnController::class, 'edit'])->name('admin.sales.return.edit')->middleware('permission:update_sales_return');
    Route::post('sales-return/edit/{sales_return}', [AdminSalesReturnController::class, 'update'])->name('admin.sales.return.update');
    Route::get('sales-return/delete/{sales_return}', [AdminSalesReturnController::class, 'destroy'])->name('admin.sales.return.destroy')->middleware('permission:delete_sales_return');
    Route::get('sales-return/confirm/{sales_return}', [AdminSalesReturnController::class, 'calculateSalesReturnTransactionOverview'])->name('admin.sales.return.confirm');

    /*
    |----------------------------------------------------------
    |Financial Statement Management
    |----------------------------------------------------------
    */
    Route::get('admin-financial-statement', [AdminFinanceController::class, 'index'])->name('admin.financial.statement')->middleware('permission:browse_statement');
    Route::get('admin-generate-monthly-statement', [AdminFinanceController::class, 'adminGenerateMonthlyStatement'])->name('admin.generate.monthly.statement')->middleware('permission:create_statement');
    Route::get('seller/monthly/statement', [AdminFinanceController::class, 'sellerMonthlyStatement'])->name('seller.monthly.statement');
    Route::get('/admin/view/monthly/statement/{id}', [AdminFinanceController::class, 'financialOverviewByMonth'])->name('admin.view.monthly.statement');
    Route::post('admin/payto/seller/{id}', [AdminFinanceController::class, 'paySeller'])->name('admin.payto.seller');
    Route::get('/admin/transaction-overview', [AdminFinanceController::class, 'sellerTransactionOverview'])->name('admin.view.transaction.overview');
    Route::get('/admin/transaction-overview/{transaction_type}/{year}/{month}/{seller_id}', [AdminFinanceController::class, 'transactionOverview'])->name('admin.transaction.overview');
    Route::get('/admin/fetch/transaction-overview', [AdminFinanceController::class, 'fetchTtransactionOverview'])->name('admin.fetch.seller.transaction.overview');

    /*
    |----------------------------------------------------------
    |Affiliate Financial Statement Management
    |----------------------------------------------------------
    */
    Route::get('admin-affiliate-financial-statement', [AdminAssociateFinanceController::class, 'index'])->name('admin.affiliate.financial.statement')->middleware('permission:browse_affiliate_statement');
    Route::get('admin-generate-affiliate-monthly-statement', [AdminAssociateFinanceController::class, 'adminGenerateAffiliateMonthlyStatement'])->name('admin.generate.affiliate.monthly.statement')->middleware('permission:create_affiliate_statement');
    Route::get('/admin/affiliate-transaction-overview', [AdminAssociateFinanceController::class, 'affiliateTransactionOverview'])->name('admin.view.affiliate.transaction.overview');
    Route::get('affiliate/monthly/statement', [AdminAssociateFinanceController::class, 'affiliateMonthlyStatement'])->name('affiliate.monthly.statement');
    Route::get('/admin/view/affiliate/monthly/statement/{id}', [AdminAssociateFinanceController::class, 'financialOverviewByMonth'])->name('admin.view.affiliate.monthly.statement');
    Route::post('admin/payto/affiliate/{id}', [AdminAssociateFinanceController::class, 'payAffiliate'])->name('admin.payto.affiliate');
    Route::get('/admin-affiliate/transaction-overview//{year}/{month}/{seller_id}', [AdminAssociateFinanceController::class, 'transactionOverview'])->name('admin.affiliate.transaction.overview');
    Route::get('/admin/fetch/affiliate-transaction-overview', [AdminAssociateFinanceController::class, 'fetchTransactionOverview'])->name('admin.fetch.affiliate.transaction.overview');
    Route::get('/admin-affiliate/return-transaction-overview/{year}/{month}/{seller_id}', [AdminAssociateFinanceController::class, 'returnTransactionOverview'])->name('admin.affiliate.refund.transaction.overview');
    Route::get('/admin/fetch/return-affiliate-transaction-overview', [AdminAssociateFinanceController::class, 'fetchReturnTransactionOverview'])->name('admin.fetech.affiliate.refund.transaction.overview');
});


////////////////Affiliate Register Routes///////////////////////
Route::get('/affiliate/signup', [AffiliateRegisterController::class, 'showRegisterForm'])->name('affiliate.register');
Route::post('/affiliate/signup', [AffiliateRegisterController::class, 'register'])->name('affiliate.register.post');
Route::post('/affiliate/verification', [AffiliateRegisterController::class, 'verification'])->name('affiliate.verification');
Route::get('/affiliate/otp/{affiliate_code}', [AffiliateRegisterController::class, 'showOTPForm'])->name('affiliate.otp');
Route::get('/affiliate/success', [AffiliateRegisterController::class, 'success'])->name('affiliate.success');

////////////////Customer Register Routes///////////////////////
Route::get('/signup', [CustomerLoginController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/signup', [CustomerRegisterController::class, 'register'])->name('customer.register.post');
Route::post('/verification', [CustomerRegisterController::class, 'verification'])->name('customer.verification');
Route::get('/otp/{id}', [CustomerRegisterController::class, 'showOTPForm'])->name('customer.otp');
// Route::get('/resend/{id}', 'Customer\Auth\CustomerLoginController@resendOTP')->name('customer.otp.resend');

////////////////Customer Login Routes///////////////////////
Route::get('/signin', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('/signin', [CustomerLoginController::class, 'login'])->name('customer.login.submit');
Route::get('/customer/logout', [CustomerLoginController::class, 'accountlogout'])->name('customer.logout');
Route::get('/dashboard', [CustomerDashboardController::class, 'profile'])->name('customer.dashboard');
Route::get('/dashboard/profile', [CustomerDashboardController::class, 'profile'])->name('customer.dashboard.profile');
Route::get('/dashboard/profile/edit/{id}', [CustomerDashboardController::class, 'editProfile'])->name('customer.dashboard.profile.edit');
Route::post('/dashboard/profile/update/{id}', [CustomerDashboardController::class, 'updateProfile'])->name('customer.dashboard.profile.update');
Route::get('/dashboard/payment/edit/{id}', [CustomerDashboardController::class, 'editPayment'])->name('customer.dashboard.payment.edit');
Route::post('/dashboard/payment/update/{id}', [CustomerDashboardController::class, 'updatePayment'])->name('customer.dashboard.payment.update');
Route::get('/dashboard/orders', [CustomerDashboardController::class, 'orders'])->name('customer.dashboard.orders');
Route::get('/dashboard/complete/orders', [CustomerDashboardController::class, 'completeOrders'])->name('customer.dashboard.complete.orders');
Route::get('/dashboard/cancellations', [CustomerDashboardController::class, 'cancellation'])->name('customer.dashboard.cancellations');
Route::get('/dashboard/wishlist', [CustomerDashboardController::class, 'wishlist'])->name('customer.dashboard.wishlist');
Route::get('/dashboard/favourite-stores', [CustomerDashboardController::class, 'favouriteStores'])->name('customer.dashboard.favourite.stores');
Route::get('/dashboard/vouchers', [CustomerDashboardController::class, 'vouchers'])->name('customer.dashboard.vouchers');
Route::get('/dashboard/returns', [CustomerDashboardController::class, 'returns'])->name('customer.dashboard.returns');

Route::get('/dashboard/chat', [CustomerChatController::class, 'chat'])->name('customer.dashboard.chat');
Route::get('/dashboard/chat/seller/{seller_id}', [CustomerChatController::class, 'chatWithSeller'])->name('customer.seller.chat');
Route::post('/dashboard/chat/seller/reply', [CustomerChatController::class, 'chatReply'])->name('customer.seller.reply');

Route::get('/dashboard/feedback', [CustomerDashboardController::class, 'feedback'])->name('customer.dashboard.feedback');
Route::get('/dashboard/help-and-support', [CustomerDashboardController::class, 'support'])->name('customer.dashboard.support');
Route::get('/dashboard/online-payment/{id}', [CustomerDashboardController::class, 'onlinePayment'])->name('customer.dashboard.online.payment');

Route::post('/dashboard/orders/{id}/cancel', [CustomerDashboardController::class, 'cancelOrder'])->name('customer.order.cancel');
Route::get('/dashboard/orders/{id}', [CustomerDashboardController::class, 'showOrder'])->name('customer.order.view');
Route::get('/dashboard/complete/orders/{id}', [CustomerDashboardController::class, 'showCompleteOrder'])->name('customer.complete.order.view');
Route::get('/dashboard/cancellations/{id}', [CustomerDashboardController::class, 'showCancel'])->name('customer.cancel.view');

Route::get('login/{provider}', [CustomerLoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [CustomerLoginController::class, 'handleProviderCallback']);

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/users/logout', [LoginController::class, 'userLogout'])->name('user.logout');

//////////////////////////////////////Customer Forget Password////////////////////////////
Route::post('customer/password/email', [CustomerAuthForgotPasswordController::class, 'sendResetLinkEmail'])->name('customer.password.email');
Route::get('customer/password/reset', [CustomerAuthForgotPasswordController::class, 'showLinkRequestForm'])->name('customer.password.request');
Route::post('customer/password/reset', [CustomerAuthResetPasswordController::class, 'reset']);
Route::get('customer/password/reset/{token}', [CustomerAuthResetPasswordController::class, 'showResetForm'])->name('customer.password.reset');

//------------------Customer Update Profile Route------------------//
// Route::get('/customer/edit/{customer}', CustomerDashboardController::class,'edit');
// Route::post('/customer/edit/{customer}', CustomerDashboardController::class,'update');

// Route::get('/customer/post', 'Customer\CustomerPostController@chooseParentCategory')->name('customer.parent');
// Route::get('/customer/post/{parent_category_slug}', 'Customer\CustomerPostController@chooseSubCategory')->name('customer.sub');
// Route::get('/customer/post/parent/{sub_category_slug}', 'Customer\CustomerPostController@chooseChildCategory')->name('customer.child');
// Route::get('/customer/post/details/{child_category_slug}', 'Customer\CustomerPostController@postdetails')->name('customer.post');
// Route::post('/post/add/{child_category_slug}', 'Customer\CustomerPostController@store');

/*
|----------------------------------------------------------
|Website Management
|----------------------------------------------------------
*/
/* Route::get('/', [WebsiteController::class, 'commingsoon'])->name('commingsoon'); */
Route::get('/', [WebsiteController::class, 'index'])->name('home.index');

//------------------Cart Route------------------//
Route::get('/addToCart/{id}', [CartController::class, 'getAddToCart'])->name('product.addToCart');
Route::get('/cart', [CartController::class, 'getCart'])->name('product.cart');
Route::get('/cartStockError/{noProduct}', [CartController::class, 'getStockErrorCart'])->name('stock.product.cart');
Route::get('/cartProductError/{noProduct}', [CartController::class, 'getProductErrorCart'])->name('product.product.cart');
Route::get('/updateAddToCart', [CartController::class, 'updateAddToCart'])->name('product.updateAddToCart');
Route::get('/reduceByOne/{id}', [CartController::class, 'getReduceByOne'])->name('product.getReduceByOne');
Route::get('/increaseByOne/{id}', [CartController::class, 'getIncreaseByOne'])->name('product.getIncreaseByOne');
Route::get('/removeProduct/{id}', [CartController::class, 'getRemoveItem'])->name('product.remove');
Route::get('/checkout', [CartController::class, 'getCheckout'])->name('product.checkout')->middleware('auth:web');

//------------------Ajax Cart Route------------------//
Route::post('/ajax/addToCart', [AjaxCartController::class, 'getAddToCart'])->name('product.ajax.addToCart');
Route::post('/ajax/removeFromCart', [AjaxCartController::class, 'getRemoveFromCart'])->name('product.ajax.removeFromCart');
Route::post('/ajax/updateCart', [AjaxCartController::class, 'getUpdateCart'])->name('product.ajax.updateCart');





//------------------Checkout Route------------------//
Route::post('/checkout/submit', [CheckoutController::class, 'submitCheckout'])->name('product.checkout.submit');
Route::get('/checkout/{ref_id}', [CheckoutController::class, 'showSuccess'])->name('product.checkout.show');
Route::get('/success', [CheckoutController::class, 'success']);
Route::get('/checkout/failure', [CheckoutController::class, 'failure']);
Route::post('payment/verification', [CheckoutController::class, 'verification']);
Route::post('/verifyStock', [CheckoutController::class, 'verifyStock']);

//------------------Checkout Route For ImePay------------------//
Route::get('/checkout/ime/{id}', [CheckoutController::class, 'processToken']);
Route::post('/payment/success', [CheckoutController::class, 'imeSuccess']);
Route::get('/payment/success', function () {
    return redirect('/');
});

Route::post('order-update', [ControllersOrderUpdateController::class, 'orderUpdate'])->name('customer.order.update');

//------------------Checkout Route For Android - Khalti------------------//
// Route::post('api/khalti/payment/verification', 'Api/CheckoutController@khaltiVerification');
Route::get('checkout/khalti/success/{res}', [CheckoutController::class, 'khaltiSuccess']);
Route::get('/execute-payment/{id}', [CheckoutController::class, 'execute']);

Route::get('/product/{product_slug}', [WebsiteController::class, 'showProduct'])->name('product.details');

Route::get('/category/{category_slug}', [WebsiteController::class, 'showCategory'])->name('product.category');

Route::get('/seller/{seller_code}', [WebsiteController::class, 'showSeller'])->name('product.seller');

Route::post('/subscribe', [WebsiteController::class, 'subscribe'])->name('subscribe');
Route::post('/contact', [WebsiteController::class, 'contact'])->name('contact');

//------------------Compare Route------------------//
Route::get('/compare', [CompareController::class, 'show'])->name('product.compare');
Route::get('/addToCompare/{id}', [CompareController::class, 'add'])->name('product.addToCompare');
Route::get('/removeFromCompare/{id}', [CompareController::class, 'remove'])->name('product.removeFromCompare');

//------------------Wishlist Route------------------//
Route::get('/wishlist', [WishlistController::class, 'show'])->name('product.wishlist');
Route::get('/addToWishlist/{id}', [WishlistController::class, 'add'])->name('product.addToWishlist');
Route::get('/removeFromWishlist/{id}', [WishlistController::class, 'remove'])->name('product.removeFromWishlist');

//------------------News Route------------------//
Route::get('/news', [NewsController::class, 'news'])->name('news');
Route::get('/news/{news_url}', [NewsController::class, 'showNews'])->name('news.details');
Route::get('/news/category/{category_url}', [NewsController::class, 'newsByCategory'])->name('news.category');
Route::get('/news/tag/{tag_url}', [NewsController::class, 'newsByTag'])->name('news.tag');
Route::post('/news/comment', [NewsController::class, 'comment'])->name('news.comment');

//------------------Filter Routes------------------//
Route::get('/filter/seller', [FilterController::class, 'sellerFilter'])->name('seller.filter');
Route::get('/filter/category', [FilterController::class, 'categoryFilter'])->name('category.filter');

Route::post('product-search', SearchController::class)->name('product-search');
Route::get('/search', [WebsiteController::class, 'search'])->name('search');

Route::get('/track-order', [WebsiteController::class, 'showTrackOrder'])->name('track.order');
Route::post('/track-order', [WebsiteController::class, 'trackOrder'])->name('track.order.post');

Route::post('/review', [WebsiteController::class, 'submitReview'])->name('review');

Route::get('get-ip-details', [WebsiteController::class, 'getLocationFromIp']);

Route::get('/dollar-today', [CheckoutController::class, 'getExchangeRate']);
// Route::get('/privacy-policy', WebsiteController::class,'showPrivacy');

// Route::get('/terms-and-conditions', WebsiteController::class,'showTerms');

Route::get('/404', [WebsiteController::class, 'show404'])->name('website.404');
Route::get('/download/{ref_id}', [CheckoutController::class, 'downloadPdf'])->name('customer.downloadpdf');

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);

Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook'])->name('facebook.login');

Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback'])->name('google.login');


//Checkout
Route::post('api/cashPayment', [CheckoutController::class, 'cashPaymentApi']);
Route::post('api/esewa', [CheckoutController::class, 'esewaCheckoutApi']);
Route::post('api/hbl', [CheckoutController::class, 'hblCheckoutApi']);
Route::post('api/getHblHash', [CheckoutController::class, 'getHblHash'])->name('getHblHash');
Route::post('api/khalti', [CheckoutController::class, 'khaltiCheckoutApi']);
Route::post('api/paypal', [CheckoutController::class, 'PaypalCheckoutApi']);
Route::post('api/imepay', [CheckoutController::class, 'imePaymentApi']);
Route::post('api/verifyStock', [CheckoutController::class, 'verifyStock']);
Route::post('api/verifyProduct', [CheckoutController::class, 'verifyProduct']);
Route::any('payment/success', [CheckoutController::class, 'success'])->name('payment.success');
Route::any('payment/hbl/success', [CheckoutController::class, 'hblSuccess'])->name('payment.hbl.success');
Route::any('payment/failure', [CheckoutController::class, 'failure'])->name('payment.failure');
Route::any('/payment/verification', [CheckoutController::class, 'verification'])->name('khalti.verification');
Route::any('/checkout/khalti/success/{ref_id}', [CheckoutController::class, 'khaltiSuccess']);
Route::post('/getCoupon', [CheckoutController::class, 'getCoupon'])->name('getCoupon');
Route::post('/getDeliveryCharge', [CheckoutController::class, 'getDeliveryCharge'])->name('getDeliveryCharge');

// Route::get('/success',function(){
//     return redirect('/');
// });

//------------------Content Route------------------//
Route::get('/termsandcondition', [WebsiteController::class, 'termsandcondition'])->name('termsandcondition');
Route::get('/privacy', [WebsiteController::class, 'privacy'])->name('privacy');
Route::get('/termsofuse', [WebsiteController::class, 'termsofuse'])->name('termsofuse');
Route::get('/{content_url}', [WebsiteController::class, 'content'])->name('content');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
