<?php

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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::post('updateStatuses', 'HomeController@updateStatuses')->name('updateStatuses');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Brands
    Route::delete('brands/destroy', 'BrandsController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/media', 'BrandsController@storeMedia')->name('brands.storeMedia');
    Route::post('brands/ckmedia', 'BrandsController@storeCKEditorImages')->name('brands.storeCKEditorImages');
    Route::resource('brands', 'BrandsController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::post('products/sku_combination_edit', 'ProductController@sku_combination_edit')->name('products.sku_combination_edit');
    Route::post('products/sku_combination', 'ProductController@sku_combination')->name('products.sku_combination');
    Route::post('products/attribute_options', 'ProductController@attribute_options')->name('products.attribute_options');
    Route::post('products/attribute_options_edit', 'ProductController@attribute_options_edit')->name('products.attribute_options_edit');
    Route::post('products/update', 'ProductController@update')->name('products.update');
    Route::resource('products', 'ProductController')->except('update');

    // Product Favorites
    Route::delete('product-favorites/destroy', 'ProductFavoritesController@massDestroy')->name('product-favorites.massDestroy');
    Route::resource('product-favorites', 'ProductFavoritesController');

    // Districts
    Route::delete('districts/destroy', 'DistrictsController@massDestroy')->name('districts.massDestroy');
    Route::resource('districts', 'DistrictsController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CitiesController');

    // Stores
    Route::delete('stores/destroy', 'StoresController@massDestroy')->name('stores.massDestroy');
    Route::post('stores/media', 'StoresController@storeMedia')->name('stores.storeMedia');
    Route::post('stores/ckmedia', 'StoresController@storeCKEditorImages')->name('stores.storeCKEditorImages');
    Route::resource('stores', 'StoresController');

    // Cart
    Route::delete('carts/destroy', 'CartController@massDestroy')->name('carts.massDestroy');
    Route::resource('carts', 'CartController');

    // Orders
    Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrdersController');

    // Order Details
    Route::delete('order-details/destroy', 'OrderDetailsController@massDestroy')->name('order-details.massDestroy');
    Route::resource('order-details', 'OrderDetailsController');

    // Refund Requests
    Route::delete('refund-requests/destroy', 'RefundRequestsController@massDestroy')->name('refund-requests.massDestroy');
    Route::post('refund-requests/media', 'RefundRequestsController@storeMedia')->name('refund-requests.storeMedia');
    Route::post('refund-requests/ckmedia', 'RefundRequestsController@storeCKEditorImages')->name('refund-requests.storeCKEditorImages');
    Route::resource('refund-requests', 'RefundRequestsController');

    // Product Reviews
    Route::delete('product-reviews/destroy', 'ProductReviewsController@massDestroy')->name('product-reviews.massDestroy');
    Route::resource('product-reviews', 'ProductReviewsController');

    // Popups
    Route::delete('popups/destroy', 'PopupsController@massDestroy')->name('popups.massDestroy');
    Route::post('popups/media', 'PopupsController@storeMedia')->name('popups.storeMedia');
    Route::post('popups/ckmedia', 'PopupsController@storeCKEditorImages')->name('popups.storeCKEditorImages');
    Route::resource('popups', 'PopupsController');

    // Sliders
    Route::delete('sliders/destroy', 'SlidersController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SlidersController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SlidersController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::resource('sliders', 'SlidersController');

    // Address
    Route::delete('addresses/destroy', 'AddressController@massDestroy')->name('addresses.massDestroy');
    Route::resource('addresses', 'AddressController');

    // Customers
    Route::delete('customers/destroy', 'CustomersController@massDestroy')->name('customers.massDestroy');
    Route::resource('customers', 'CustomersController');

    // Attributes
    Route::delete('attributes/destroy', 'AttributesController@massDestroy')->name('attributes.massDestroy');
    Route::resource('attributes', 'AttributesController');

    // Regions
    Route::delete('regions/destroy', 'RegionsController@massDestroy')->name('regions.massDestroy');
    Route::resource('regions', 'RegionsController');

    // Store Followers
    Route::delete('store-followers/destroy', 'StoreFollowersController@massDestroy')->name('store-followers.massDestroy');
    Route::resource('store-followers', 'StoreFollowersController');

    // Store Complaints
    Route::delete('store-complaints/destroy', 'StoreComplaintsController@massDestroy')->name('store-complaints.massDestroy');
    Route::resource('store-complaints', 'StoreComplaintsController');

    // Product Complaints
    Route::delete('product-complaints/destroy', 'ProductComplaintsController@massDestroy')->name('product-complaints.massDestroy');
    Route::resource('product-complaints', 'ProductComplaintsController');

    // Product Stock Remember
    Route::delete('product-stock-remembers/destroy', 'ProductStockRememberController@massDestroy')->name('product-stock-remembers.massDestroy');
    Route::resource('product-stock-remembers', 'ProductStockRememberController');

    // Payment Methods
    Route::delete('payment-methods/destroy', 'PaymentMethodsController@massDestroy')->name('payment-methods.massDestroy');
    Route::resource('payment-methods', 'PaymentMethodsController');

    // Coupons
    Route::delete('coupons/destroy', 'CouponsController@massDestroy')->name('coupons.massDestroy');
    Route::resource('coupons', 'CouponsController');

    // Coupon Usages
    Route::delete('coupon-usages/destroy', 'CouponUsagesController@massDestroy')->name('coupon-usages.massDestroy');
    Route::resource('coupon-usages', 'CouponUsagesController');

    // Colors
    Route::delete('colors/destroy', 'ColorsController@massDestroy')->name('colors.massDestroy');
    Route::resource('colors', 'ColorsController');

    // Special Orders
    Route::delete('special-orders/destroy', 'SpecialOrdersController@massDestroy')->name('special-orders.massDestroy');
    Route::post('special-orders/media', 'SpecialOrdersController@storeMedia')->name('special-orders.storeMedia');
    Route::post('special-orders/ckmedia', 'SpecialOrdersController@storeCKEditorImages')->name('special-orders.storeCKEditorImages');
    Route::resource('special-orders', 'SpecialOrdersController');

    // Contactus
    Route::delete('contactus/destroy', 'ContactusController@massDestroy')->name('contactus.massDestroy');
    Route::resource('contactus', 'ContactusController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Wallet Transactions
    Route::delete('wallet-transactions/destroy', 'WalletTransactionsController@massDestroy')->name('wallet-transactions.massDestroy');
    Route::resource('wallet-transactions', 'WalletTransactionsController');

    // Customer Points
    Route::delete('customer-points/destroy', 'CustomerPointsController@massDestroy')->name('customer-points.massDestroy');
    Route::resource('customer-points', 'CustomerPointsController');

    // Attribute Values
    Route::delete('attribute-values/destroy', 'AttributeValuesController@massDestroy')->name('attribute-values.massDestroy');
    Route::resource('attribute-values', 'AttributeValuesController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::post('settings/media', 'SettingsController@storeMedia')->name('settings.storeMedia');
    Route::post('settings/ckmedia', 'SettingsController@storeCKEditorImages')->name('settings.storeCKEditorImages');
    Route::resource('settings', 'SettingsController');

    // Scratches
    Route::delete('scratches/destroy', 'ScratchesController@massDestroy')->name('scratches.massDestroy');
    Route::resource('scratches', 'ScratchesController');

    // Customer Scratches
    Route::delete('customer-scratches/destroy', 'CustomerScratchesController@massDestroy')->name('customer-scratches.massDestroy');
    Route::resource('customer-scratches', 'CustomerScratchesController');

    // Notifications
    Route::delete('notifications/destroy', 'NotificationsController@massDestroy')->name('notifications.massDestroy');
    Route::resource('notifications', 'NotificationsController');

    // Notification Types
    Route::delete('notification-types/destroy', 'NotificationTypesController@massDestroy')->name('notification-types.massDestroy');
    Route::resource('notification-types', 'NotificationTypesController');

    // Store Withdraw Requests
    Route::delete('store-withdraw-requests/destroy', 'StoreWithdrawRequestsController@massDestroy')->name('store-withdraw-requests.massDestroy');
    Route::get('store-withdraw-requests/update_status/{id}/{status}', 'StoreWithdrawRequestsController@update_status')->name('store-withdraw-requests.update_status');
    Route::resource('store-withdraw-requests', 'StoreWithdrawRequestsController');

    // Commission History
    Route::resource('commission-histories', 'CommissionHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Store Cities
    Route::delete('store-cities/destroy', 'StoreCitiesController@massDestroy')->name('store-cities.massDestroy');
    Route::resource('store-cities', 'StoreCitiesController');

    // Email Templates
    Route::delete('email-templates/destroy', 'EmailTemplatesController@massDestroy')->name('email-templates.massDestroy');
    Route::post('email-templates/media', 'EmailTemplatesController@storeMedia')->name('email-templates.storeMedia');
    Route::post('email-templates/ckmedia', 'EmailTemplatesController@storeCKEditorImages')->name('email-templates.storeCKEditorImages');
    Route::resource('email-templates', 'EmailTemplatesController');

    // Searches
    Route::resource('searches', 'SearchesController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Otp Methods
    Route::resource('otp-methods', 'OtpMethodsController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Sms Templates
    Route::post('sms-templates/media', 'SmsTemplatesController@storeMedia')->name('sms-templates.storeMedia');
    Route::post('sms-templates/ckmedia', 'SmsTemplatesController@storeCKEditorImages')->name('sms-templates.storeCKEditorImages');
    Route::resource('sms-templates', 'SmsTemplatesController', ['except' => ['create', 'store', 'show', 'destroy']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
