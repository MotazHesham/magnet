<?php

use App\Http\Controllers\Admin\BusinessSettingsController;
use App\Http\Controllers\Admin\Country\CitiesController;
use App\Http\Controllers\Admin\Country\DistrictsController;
use App\Http\Controllers\Admin\Country\RegionsController;
use App\Http\Controllers\Admin\Coupon\CouponsController;
use App\Http\Controllers\Admin\Coupon\CouponUsagesController;
use App\Http\Controllers\Admin\Coupon\CustomerScratchesController;
use App\Http\Controllers\Admin\Coupon\ScratchesController;
use App\Http\Controllers\Admin\Customer\AddressController;
use App\Http\Controllers\Admin\Customer\CustomerPointsController;
use App\Http\Controllers\Admin\Customer\CustomersController;
use App\Http\Controllers\Admin\Customer\WalletTransactionsController;
use App\Http\Controllers\Admin\Faq\FaqCategoryController;
use App\Http\Controllers\Admin\Faq\FaqQuestionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Marketing\CartController;
use App\Http\Controllers\Admin\Marketing\EmailTemplatesController;
use App\Http\Controllers\Admin\Marketing\NotificationCustomController;
use App\Http\Controllers\Admin\Marketing\NotificationTypesController;
use App\Http\Controllers\Admin\Marketing\ProductFavoritesController;
use App\Http\Controllers\Admin\Marketing\ProductStockRememberController;
use App\Http\Controllers\Admin\Marketing\SearchesController;
use App\Http\Controllers\Admin\Order\OrderDetailsController;
use App\Http\Controllers\Admin\Order\OrdersController;
use App\Http\Controllers\Admin\Order\RefundRequestsController;
use App\Http\Controllers\Admin\Order\SpecialOrdersController;
use App\Http\Controllers\Admin\Otp\OtpMethodsController;
use App\Http\Controllers\Admin\Otp\SmsTemplatesController;
use App\Http\Controllers\Admin\Product\AttributesController;
use App\Http\Controllers\Admin\Product\AttributeValuesController;
use App\Http\Controllers\Admin\Product\BrandsController;
use App\Http\Controllers\Admin\Product\ColorsController;
use App\Http\Controllers\Admin\Product\ProductCategoryController;
use App\Http\Controllers\Admin\Product\ProductComplaintsController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\ProductReviewsController;
use App\Http\Controllers\Admin\Setting\ContactusController;
use App\Http\Controllers\Admin\Setting\PaymentMethodsController;
use App\Http\Controllers\Admin\Setting\PopupsController;
use App\Http\Controllers\Admin\Setting\SettingsController;
use App\Http\Controllers\Admin\Setting\SlidersController;
use App\Http\Controllers\Admin\Store\CommissionHistoryController;
use App\Http\Controllers\Admin\Store\StoreCitiesController;
use App\Http\Controllers\Admin\Store\StoreComplaintsController;
use App\Http\Controllers\Admin\Store\StoreFollowersController;
use App\Http\Controllers\Admin\Store\StoresController;
use App\Http\Controllers\Admin\Store\StoreWithdrawRequestsController;
use App\Http\Controllers\Admin\User\AuditLogsController;
use App\Http\Controllers\Admin\User\RolesController;
use App\Http\Controllers\Admin\User\UsersController;
use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','staff']], function () {

    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::post('updateStatuses', [HomeController::class,'updateStatuses'])->name('updateStatuses');

    // Business Settings 
    Route::post('env_key_update', [BusinessSettingsController::class,'env_key_update'])->name('bussiness-settings.env_key_update');
    Route::post('test-smtp', [BusinessSettingsController::class,'testEmail'])->name('bussiness-settings.test-smtp');
    Route::get('smtp-settings', [BusinessSettingsController::class,'smtp_settings'])->name('smtp-settings');   

    // Roles
    Route::delete('roles/destroy', [RolesController::class,'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class,'massDestroy'])->name('users.massDestroy');
    Route::post('users/media', [UsersController::class,'storeMedia'])->name('users.storeMedia');
    Route::post('users/ckmedia', [UsersController::class,'storeCKEditorImages'])->name('users.storeCKEditorImages');
    Route::resource('users', UsersController::class);

    // Audit Logs
    Route::resource('audit-logs',  AuditLogsController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
        
    // Faq Category
    Route::delete('faq-categories/destroy', [FaqCategoryController::class,'massDestroy'])->name('faq-categories.massDestroy');
    Route::resource('faq-categories', FaqCategoryController::class);

    // Faq Question
    Route::delete('faq-questions/destroy', [FaqQuestionController::class,'massDestroy'])->name('faq-questions.massDestroy');
    Route::resource('faq-questions', FaqQuestionController::class);
        
    // Product Category
    Route::delete('product-categories/destroy', [ProductCategoryController::class,'massDestroy'])->name('product-categories.massDestroy');
    Route::post('product-categories/media', [ProductCategoryController::class,'storeMedia'])->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', [ProductCategoryController::class,'storeCKEditorImages'])->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', ProductCategoryController::class);

    // Brands
    Route::delete('brands/destroy', [BrandsController::class,'massDestroy'])->name('brands.massDestroy');
    Route::post('brands/media', [BrandsController::class,'storeMedia'])->name('brands.storeMedia');
    Route::post('brands/ckmedia', [BrandsController::class,'storeCKEditorImages'])->name('brands.storeCKEditorImages');
    Route::resource('brands', BrandsController::class);

    // Product
    Route::delete('products/destroy', [ProductController::class,'massDestroy'])->name('products.massDestroy');
    Route::post('products/media', [ProductController::class,'storeMedia'])->name('products.storeMedia');
    Route::post('products/ckmedia', [ProductController::class,'storeCKEditorImages'])->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', [ProductController::class,'parseCsvImport'])->name('products.parseCsvImport');
    Route::post('products/process-csv-import', [ProductController::class,'processCsvImport'])->name('products.processCsvImport');
    Route::post('products/sku_combination_edit', [ProductController::class,'sku_combination_edit'])->name('products.sku_combination_edit');
    Route::post('products/sku_combination', [ProductController::class,'sku_combination'])->name('products.sku_combination');
    Route::post('products/attribute_options', [ProductController::class,'attribute_options'])->name('products.attribute_options');
    Route::post('products/attribute_options_edit', [ProductController::class,'attribute_options_edit'])->name('products.attribute_options_edit');
    Route::post('products/update', [ProductController::class,'update'])->name('products.update');
    Route::resource('products', ProductController::class)->except('update');

    // Product Favorites
    Route::delete('product-favorites/destroy', [ProductFavoritesController::class,'massDestroy'])->name('product-favorites.massDestroy');
    Route::resource('product-favorites', ProductFavoritesController::class);

    // Districts
    Route::delete('districts/destroy', [DistrictsController::class,'massDestroy'])->name('districts.massDestroy');
    Route::resource('districts', DistrictsController::class);

    // Cities
    Route::delete('cities/destroy', [CitiesController::class,'massDestroy'])->name('cities.massDestroy');
    Route::resource('cities', CitiesController::class);

    // Stores
    Route::delete('stores/destroy', [StoresController::class,'massDestroy'])->name('stores.massDestroy');
    Route::post('stores/media', [StoresController::class,'storeMedia'])->name('stores.storeMedia');
    Route::post('stores/ckmedia', [StoresController::class,'storeCKEditorImages'])->name('stores.storeCKEditorImages');
    Route::resource('stores', StoresController::class);

    // Cart
    Route::delete('carts/destroy', [CartController::class,'massDestroy'])->name('carts.massDestroy');
    Route::resource('carts', CartController::class);

    // Orders
    Route::delete('orders/destroy', [OrdersController::class,'massDestroy'])->name('orders.massDestroy');
    Route::resource('orders', OrdersController::class);

    // Order Details
    Route::delete('order-details/destroy', [OrderDetailsController::class,'massDestroy'])->name('order-details.massDestroy');
    Route::resource('order-details', OrderDetailsController::class);

    // Refund Requests
    Route::delete('refund-requests/destroy', [RefundRequestsController::class,'massDestroy'])->name('refund-requests.massDestroy');
    Route::post('refund-requests/media', [RefundRequestsController::class,'storeMedia'])->name('refund-requests.storeMedia');
    Route::post('refund-requests/ckmedia', [RefundRequestsController::class,'storeCKEditorImages'])->name('refund-requests.storeCKEditorImages');
    Route::resource('refund-requests', RefundRequestsController::class);

    // Product Reviews
    Route::delete('product-reviews/destroy', [ProductReviewsController::class,'massDestroy'])->name('product-reviews.massDestroy');
    Route::resource('product-reviews', ProductReviewsController::class);

    // Popups
    Route::delete('popups/destroy', [PopupsController::class,'massDestroy'])->name('popups.massDestroy');
    Route::post('popups/media', [PopupsController::class,'storeMedia'])->name('popups.storeMedia');
    Route::post('popups/ckmedia', [PopupsController::class,'storeCKEditorImages'])->name('popups.storeCKEditorImages');
    Route::resource('popups', PopupsController::class);

    // Sliders
    Route::delete('sliders/destroy', [SlidersController::class,'massDestroy'])->name('sliders.massDestroy');
    Route::post('sliders/media', [SlidersController::class,'storeMedia'])->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', [SlidersController::class,'storeCKEditorImages'])->name('sliders.storeCKEditorImages');
    Route::resource('sliders', SlidersController::class);

    // Address
    Route::delete('addresses/destroy', [AddressController::class,'massDestroy'])->name('addresses.massDestroy');
    Route::resource('addresses', AddressController::class);

    // Customers
    Route::delete('customers/destroy', [CustomersController::class,'massDestroy'])->name('customers.massDestroy');
    Route::resource('customers', CustomersController::class);

    // Attributes
    Route::delete('attributes/destroy', [AttributesController::class,'massDestroy'])->name('attributes.massDestroy');
    Route::resource('attributes', AttributesController::class);

    // Regions
    Route::delete('regions/destroy', [RegionsController::class,'massDestroy'])->name('regions.massDestroy');
    Route::resource('regions', RegionsController::class);

    // Store Followers
    Route::delete('store-followers/destroy', [StoreFollowersController::class,'massDestroy'])->name('store-followers.massDestroy');
    Route::resource('store-followers', StoreFollowersController::class);

    // Store Complaints
    Route::delete('store-complaints/destroy', [StoreComplaintsController::class,'massDestroy'])->name('store-complaints.massDestroy');
    Route::resource('store-complaints', StoreComplaintsController::class);

    // Product Complaints
    Route::delete('product-complaints/destroy', [ProductComplaintsController::class,'massDestroy'])->name('product-complaints.massDestroy');
    Route::resource('product-complaints', ProductComplaintsController::class);

    // Product Stock Remember
    Route::delete('product-stock-remembers/destroy', [ProductStockRememberController::class,'massDestroy'])->name('product-stock-remembers.massDestroy');
    Route::resource('product-stock-remembers', ProductStockRememberController::class);

    // Payment Methods
    Route::delete('payment-methods/destroy', [PaymentMethodsController::class,'massDestroy'])->name('payment-methods.massDestroy');
    Route::post('payment-methods/update', [PaymentMethodsController::class,'update'])->name('payment-methods.update');
    Route::post('payment-methods/update_status', [PaymentMethodsController::class,'update_status'])->name('payment-methods.update_status');
    Route::resource('payment-methods', PaymentMethodsController::class)->except('update');

    // Coupons
    Route::delete('coupons/destroy', [CouponsController::class,'massDestroy'])->name('coupons.massDestroy');
    Route::resource('coupons', CouponsController::class);

    // Coupon Usages
    Route::delete('coupon-usages/destroy', [CouponUsagesController::class,'massDestroy'])->name('coupon-usages.massDestroy');
    Route::resource('coupon-usages', CouponUsagesController::class);

    // Colors
    Route::delete('colors/destroy', [ColorsController::class,'massDestroy'])->name('colors.massDestroy');
    Route::resource('colors', ColorsController::class);

    // Special Orders
    Route::delete('special-orders/destroy', [SpecialOrdersController::class,'massDestroy'])->name('special-orders.massDestroy');
    Route::post('special-orders/media', [SpecialOrdersController::class,'storeMedia'])->name('special-orders.storeMedia');
    Route::post('special-orders/ckmedia', [SpecialOrdersController::class,'storeCKEditorImages'])->name('special-orders.storeCKEditorImages');
    Route::resource('special-orders', SpecialOrdersController::class);

    // Contactus
    Route::delete('contactus/destroy', [ContactusController::class,'massDestroy'])->name('contactus.massDestroy');
    Route::resource('contactus', ContactusController::class, ['except' => ['create', 'store', 'edit', 'update']]);

    // Wallet Transactions
    Route::delete('wallet-transactions/destroy', [WalletTransactionsController::class,'massDestroy'])->name('wallet-transactions.massDestroy');
    Route::resource('wallet-transactions', WalletTransactionsController::class);

    // Customer Points
    Route::delete('customer-points/destroy', [CustomerPointsController::class,'massDestroy'])->name('customer-points.massDestroy');
    Route::resource('customer-points', CustomerPointsController::class);

    // Attribute Values
    Route::delete('attribute-values/destroy', [AttributeValuesController::class,'massDestroy'])->name('attribute-values.massDestroy');
    Route::resource('attribute-values', AttributeValuesController::class);

    // Settings
    Route::delete('settings/destroy', [SettingsController::class,'massDestroy'])->name('settings.massDestroy');
    Route::post('settings/media', [SettingsController::class,'storeMedia'])->name('settings.storeMedia');
    Route::post('settings/ckmedia', [SettingsController::class,'storeCKEditorImages'])->name('settings.storeCKEditorImages');
    Route::resource('settings', SettingsController::class);

    // Scratches
    Route::delete('scratches/destroy', [ScratchesController::class,'massDestroy'])->name('scratches.massDestroy');
    Route::resource('scratches', ScratchesController::class);

    // Customer Scratches
    Route::delete('customer-scratches/destroy', [CustomerScratchesController::class,'massDestroy'])->name('customer-scratches.massDestroy');
    Route::resource('customer-scratches', CustomerScratchesController::class);

    // Notification Custom
    Route::delete('notification-customs/destroy', [NotificationCustomController::class,'massDestroy'])->name('notification-customs.massDestroy');
    Route::resource('notification-customs', NotificationCustomController::class);

    // Notification Types
    Route::delete('notification-types/destroy', [NotificationTypesController::class,'massDestroy'])->name('notification-types.massDestroy');
    Route::resource('notification-types', NotificationTypesController::class);

    // Store Withdraw Requests
    Route::delete('store-withdraw-requests/destroy', [StoreWithdrawRequestsController::class,'massDestroy'])->name('store-withdraw-requests.massDestroy');
    Route::get('store-withdraw-requests/update_status/{id}/{status}', [StoreWithdrawRequestsController::class,'update_status'])->name('store-withdraw-requests.update_status');
    Route::resource('store-withdraw-requests', StoreWithdrawRequestsController::class);

    // Commission History
    Route::resource('commission-histories', CommissionHistoryController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Store Cities
    Route::delete('store-cities/destroy', [StoreCitiesController::class,'massDestroy'])->name('store-cities.massDestroy');
    Route::resource('store-cities', StoreCitiesController::class);

    // Email Templates
    Route::delete('email-templates/destroy', [EmailTemplatesController::class,'massDestroy'])->name('email-templates.massDestroy');
    Route::post('email-templates/media', [EmailTemplatesController::class,'storeMedia'])->name('email-templates.storeMedia');
    Route::post('email-templates/ckmedia', [EmailTemplatesController::class,'storeCKEditorImages'])->name('email-templates.storeCKEditorImages');
    Route::resource('email-templates', EmailTemplatesController::class);

    // Searches
    Route::resource('searches', SearchesController::class, ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Otp Methods
    Route::post('otp-methods/update_status', [OtpMethodsController::class,'update_status'])->name('otp-methods.update_status');
    Route::resource('otp-methods', OtpMethodsController::class, ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Sms Templates 
    Route::resource('sms-templates', SmsTemplatesController::class, ['except' => ['create', 'store', 'show', 'destroy']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () { 
    Route::get('password', [ChangePasswordController::class,'edit'])->name('password.edit');
    Route::post('password', [ChangePasswordController::class,'update'])->name('password.update');
    Route::post('profile', [ChangePasswordController::class,'updateProfile'])->name('password.updateProfile');
    Route::post('profile/destroy', [ChangePasswordController::class,'destroy'])->name('password.destroyProfile'); 
});
