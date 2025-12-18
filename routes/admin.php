<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', [\App\Http\Controllers\HomeController::class, 'admin_dashboard'])->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
	Route::resource('categories', \App\Http\Controllers\CategoryController::class)->except(['destroy']);
	Route::get('/categories/destroy/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
	Route::post('/categories/featured', [\App\Http\Controllers\CategoryController::class, 'updateFeatured'])->name('categories.featured');

	Route::resource('subcategories', \App\Http\Controllers\SubCategoryController::class)->except(['destroy']);
	Route::get('/subcategories/destroy/{id}', [\App\Http\Controllers\SubCategoryController::class, 'destroy'])->name('subcategories.destroy');

	Route::resource('subsubcategories', \App\Http\Controllers\SubSubCategoryController::class)->except(['destroy']);
	Route::get('/subsubcategories/destroy/{id}', [\App\Http\Controllers\SubSubCategoryController::class, 'destroy'])->name('subsubcategories.destroy');

	Route::resource('brands', \App\Http\Controllers\BrandController::class)->except(['destroy']);
	Route::get('/brands/destroy/{id}', [\App\Http\Controllers\BrandController::class, 'destroy'])->name('brands.destroy');

	Route::get('/products/admin', [\App\Http\Controllers\ProductController::class, 'admin_products'])->name('products.admin');
	Route::get('/products/seller', [\App\Http\Controllers\ProductController::class, 'seller_products'])->name('products.seller');
	Route::get('/products/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
	Route::get('/products/admin/{id}/edit', [\App\Http\Controllers\ProductController::class, 'admin_product_edit'])->name('products.admin.edit');
	Route::get('/products/seller/{id}/edit', [\App\Http\Controllers\ProductController::class, 'seller_product_edit'])->name('products.seller.edit');
	Route::post('/products/todays_deal', [\App\Http\Controllers\ProductController::class, 'updateTodaysDeal'])->name('products.todays_deal');
	Route::post('/products/get_products_by_subsubcategory', [\App\Http\Controllers\ProductController::class, 'get_products_by_subsubcategory'])->name('products.get_products_by_subsubcategory');

	Route::resource('sellers', \App\Http\Controllers\SellerController::class)->except(['destroy']);
	Route::get('/sellers/destroy/{id}', [\App\Http\Controllers\SellerController::class, 'destroy'])->name('sellers.destroy');
	Route::get('/sellers/view/{id}/verification', [\App\Http\Controllers\SellerController::class, 'show_verification_request'])->name('sellers.show_verification_request');
	Route::get('/sellers/approve/{id}', [\App\Http\Controllers\SellerController::class, 'approve_seller'])->name('sellers.approve');
	Route::get('/sellers/reject/{id}', [\App\Http\Controllers\SellerController::class, 'reject_seller'])->name('sellers.reject');
	Route::post('/sellers/payment_modal', [\App\Http\Controllers\SellerController::class, 'payment_modal'])->name('sellers.payment_modal');
	Route::get('/seller/payments', [\App\Http\Controllers\PaymentController::class, 'payment_histories'])->name('sellers.payment_histories');
	Route::get('/seller/payments/show/{id}', [\App\Http\Controllers\PaymentController::class, 'show'])->name('sellers.payment_history');

	Route::resource('customers', \App\Http\Controllers\CustomerController::class)->except(['destroy']);
	Route::get('/customers/destroy/{id}', [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('customers.destroy');

	Route::get('/newsletter', [\App\Http\Controllers\NewsletterController::class, 'index'])->name('newsletters.index');
	Route::post('/newsletter/send', [\App\Http\Controllers\NewsletterController::class, 'send'])->name('newsletters.send');

	Route::resource('profile', \App\Http\Controllers\ProfileController::class);

	Route::post('/business-settings/update', [\App\Http\Controllers\BusinessSettingsController::class, 'update'])->name('business_settings.update');
	Route::post('/business-settings/update/activation', [\App\Http\Controllers\BusinessSettingsController::class, 'updateActivationSettings'])->name('business_settings.update.activation');
	Route::get('/activation', [\App\Http\Controllers\BusinessSettingsController::class, 'activation'])->name('activation.index');
	Route::get('/payment-method', [\App\Http\Controllers\BusinessSettingsController::class, 'payment_method'])->name('payment_method.index');
	Route::get('/social-login', [\App\Http\Controllers\BusinessSettingsController::class, 'social_login'])->name('social_login.index');
	Route::get('/smtp-settings', [\App\Http\Controllers\BusinessSettingsController::class, 'smtp_settings'])->name('smtp_settings.index');
	Route::get('/google-analytics', [\App\Http\Controllers\BusinessSettingsController::class, 'google_analytics'])->name('google_analytics.index');
	Route::get('/facebook-chat', [\App\Http\Controllers\BusinessSettingsController::class, 'facebook_chat'])->name('facebook_chat.index');
	Route::post('/env_key_update', [\App\Http\Controllers\BusinessSettingsController::class, 'env_key_update'])->name('env_key_update.update');
	Route::post('/payment_method_update', [\App\Http\Controllers\BusinessSettingsController::class, 'payment_method_update'])->name('payment_method.update');
	Route::post('/google_analytics', [\App\Http\Controllers\BusinessSettingsController::class, 'google_analytics_update'])->name('google_analytics.update');
	Route::post('/facebook_chat', [\App\Http\Controllers\BusinessSettingsController::class, 'facebook_chat_update'])->name('facebook_chat.update');
	Route::post('/facebook_pixel', [\App\Http\Controllers\BusinessSettingsController::class, 'facebook_pixel_update'])->name('facebook_pixel.update');
	Route::get('/currency', [\App\Http\Controllers\CurrencyController::class, 'currency'])->name('currency.index');
    Route::post('/currency/update', [\App\Http\Controllers\CurrencyController::class, 'updateCurrency'])->name('currency.update');
    Route::post('/your-currency/update', [\App\Http\Controllers\CurrencyController::class, 'updateYourCurrency'])->name('your_currency.update');
	Route::get('/currency/create', [\App\Http\Controllers\CurrencyController::class, 'create'])->name('currency.create');
	Route::post('/currency/store', [\App\Http\Controllers\CurrencyController::class, 'store'])->name('currency.store');
	Route::post('/currency/currency_edit', [\App\Http\Controllers\CurrencyController::class, 'edit'])->name('currency.edit');
	Route::post('/currency/update_status', [\App\Http\Controllers\CurrencyController::class, 'update_status'])->name('currency.update_status');
	Route::get('/verification/form', [\App\Http\Controllers\BusinessSettingsController::class, 'seller_verification_form'])->name('seller_verification_form.index');
	Route::post('/verification/form', [\App\Http\Controllers\BusinessSettingsController::class, 'seller_verification_form_update'])->name('seller_verification_form.update');
	Route::get('/vendor_commission', [\App\Http\Controllers\BusinessSettingsController::class, 'vendor_commission'])->name('business_settings.vendor_commission');
	Route::post('/vendor_commission_update', [\App\Http\Controllers\BusinessSettingsController::class, 'vendor_commission_update'])->name('business_settings.vendor_commission.update');

	Route::resource('/languages', \App\Http\Controllers\LanguageController::class)->except(['destroy', 'edit', 'update']);
	Route::post('/languages/update_rtl_status', [\App\Http\Controllers\LanguageController::class, 'update_rtl_status'])->name('languages.update_rtl_status');
	Route::get('/languages/destroy/{id}', [\App\Http\Controllers\LanguageController::class, 'destroy'])->name('languages.destroy');
	Route::get('/languages/{id}/edit', [\App\Http\Controllers\LanguageController::class, 'edit'])->name('languages.edit');
	Route::post('/languages/{id}/update', [\App\Http\Controllers\LanguageController::class, 'update'])->name('languages.update');
	Route::post('/languages/key_value_store', [\App\Http\Controllers\LanguageController::class, 'key_value_store'])->name('languages.key_value_store');

	Route::get('/frontend_settings/home', [\App\Http\Controllers\HomeController::class, 'home_settings'])->name('home_settings.index');
	Route::post('/frontend_settings/home/top_10', [\App\Http\Controllers\HomeController::class, 'top_10_settings'])->name('top_10_settings.store');
	Route::get('/sellerpolicy/{type}', [\App\Http\Controllers\PolicyController::class, 'index'])->name('sellerpolicy.index');
	Route::get('/returnpolicy/{type}', [\App\Http\Controllers\PolicyController::class, 'index'])->name('returnpolicy.index');
	Route::get('/supportpolicy/{type}', [\App\Http\Controllers\PolicyController::class, 'index'])->name('supportpolicy.index');
	Route::get('/terms/{type}', [\App\Http\Controllers\PolicyController::class, 'index'])->name('terms.index');
	Route::get('/privacypolicy/{type}', [\App\Http\Controllers\PolicyController::class, 'index'])->name('privacypolicy.index');

	//Policy Controller
	Route::post('/policies/store', [\App\Http\Controllers\PolicyController::class, 'store'])->name('policies.store');

	Route::group(['prefix' => 'frontend_settings'], function(){
		Route::resource('sliders', \App\Http\Controllers\SliderController::class)->except(['destroy']);
	    Route::get('/sliders/destroy/{id}', [\App\Http\Controllers\SliderController::class, 'destroy'])->name('sliders.destroy');

		Route::resource('home_banners', \App\Http\Controllers\BannerController::class)->except(['destroy', 'create']);
		Route::get('/home_banners/create/{position}', [\App\Http\Controllers\BannerController::class, 'create'])->name('home_banners.create');
		Route::post('/home_banners/update_status', [\App\Http\Controllers\BannerController::class, 'update_status'])->name('home_banners.update_status');
	    Route::get('/home_banners/destroy/{id}', [\App\Http\Controllers\BannerController::class, 'destroy'])->name('home_banners.destroy');

		Route::resource('home_categories', \App\Http\Controllers\HomeCategoryController::class)->except(['destroy']);
	    Route::get('/home_categories/destroy/{id}', [\App\Http\Controllers\HomeCategoryController::class, 'destroy'])->name('home_categories.destroy');
		Route::post('/home_categories/update_status', [\App\Http\Controllers\HomeCategoryController::class, 'update_status'])->name('home_categories.update_status');
		Route::post('/home_categories/get_subsubcategories_by_category', [\App\Http\Controllers\HomeCategoryController::class, 'getSubSubCategories'])->name('home_categories.get_subsubcategories_by_category');
	});

	Route::resource('roles', \App\Http\Controllers\RoleController::class)->except(['destroy']);
    Route::get('/roles/destroy/{id}', [\App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');

    Route::resource('staffs', \App\Http\Controllers\StaffController::class)->except(['destroy']);
    Route::get('/staffs/destroy/{id}', [\App\Http\Controllers\StaffController::class, 'destroy'])->name('staffs.destroy');

	Route::resource('flash_deals', \App\Http\Controllers\FlashDealController::class)->except(['destroy']);
    Route::get('/flash_deals/destroy/{id}', [\App\Http\Controllers\FlashDealController::class, 'destroy'])->name('flash_deals.destroy');
	Route::post('/flash_deals/update_status', [\App\Http\Controllers\FlashDealController::class, 'update_status'])->name('flash_deals.update_status');
	Route::post('/flash_deals/update_featured', [\App\Http\Controllers\FlashDealController::class, 'update_featured'])->name('flash_deals.update_featured');
	Route::post('/flash_deals/product_discount', [\App\Http\Controllers\FlashDealController::class, 'product_discount'])->name('flash_deals.product_discount');
	Route::post('/flash_deals/product_discount_edit', [\App\Http\Controllers\FlashDealController::class, 'product_discount_edit'])->name('flash_deals.product_discount_edit');

	Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'admin_orders'])->name('admin.orders.index');
	Route::get('/orders/{id}/show', [\App\Http\Controllers\OrderController::class, 'show'])->name('admin.orders.show');
	Route::get('/sales/{id}/show', [\App\Http\Controllers\OrderController::class, 'sales_show'])->name('admin.sales.show');
	Route::get('/orders/destroy/{id}', [\App\Http\Controllers\OrderController::class, 'destroy'])->name('admin.orders.destroy');
	Route::get('/sales', [\App\Http\Controllers\OrderController::class, 'sales'])->name('sales.index');

	Route::resource('links', \App\Http\Controllers\LinkController::class)->except(['destroy']);
	Route::get('/links/destroy/{id}', [\App\Http\Controllers\LinkController::class, 'destroy'])->name('links.destroy');

	Route::resource('generalsettings', \App\Http\Controllers\GeneralSettingController::class);
	Route::get('/logo', [\App\Http\Controllers\GeneralSettingController::class, 'logo'])->name('generalsettings.logo');
	Route::post('/logo', [\App\Http\Controllers\GeneralSettingController::class, 'storeLogo'])->name('generalsettings.logo.store');
	Route::get('/color', [\App\Http\Controllers\GeneralSettingController::class, 'color'])->name('generalsettings.color');
	Route::post('/color', [\App\Http\Controllers\GeneralSettingController::class, 'storeColor'])->name('generalsettings.color.store');

	Route::resource('seosetting', \App\Http\Controllers\SEOController::class);

	Route::post('/pay_to_seller', [\App\Http\Controllers\CommissionController::class, 'pay_to_seller'])->name('commissions.pay_to_seller');

	//Reports
	Route::get('/stock_report', [\App\Http\Controllers\ReportController::class, 'stock_report'])->name('stock_report.index');
	Route::get('/in_house_sale_report', [\App\Http\Controllers\ReportController::class, 'in_house_sale_report'])->name('in_house_sale_report.index');
	Route::get('/seller_report', [\App\Http\Controllers\ReportController::class, 'seller_report'])->name('seller_report.index');
	Route::get('/seller_sale_report', [\App\Http\Controllers\ReportController::class, 'seller_sale_report'])->name('seller_sale_report.index');
	Route::get('/wish_report', [\App\Http\Controllers\ReportController::class, 'wish_report'])->name('wish_report.index');

	//Coupons
	Route::resource('coupon', \App\Http\Controllers\CouponController::class)->except(['destroy']);
	Route::post('/coupon/get_form', [\App\Http\Controllers\CouponController::class, 'get_coupon_form'])->name('coupon.get_coupon_form');
	Route::post('/coupon/get_form_edit', [\App\Http\Controllers\CouponController::class, 'get_coupon_form_edit'])->name('coupon.get_coupon_form_edit');
	Route::get('/coupon/destroy/{id}', [\App\Http\Controllers\CouponController::class, 'destroy'])->name('coupon.destroy');

	//Reviews
	Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'index'])->name('admin.reviews.index');
	Route::post('/reviews/published', [\App\Http\Controllers\ReviewController::class, 'updatePublished'])->name('admin.reviews.published');

	//Support_Ticket
	Route::get('support_ticket/', [\App\Http\Controllers\SupportTicketController::class, 'admin_index'])->name('support_ticket.admin_index');
	Route::get('support_ticket/{id}/show', [\App\Http\Controllers\SupportTicketController::class, 'admin_show'])->name('support_ticket.admin_show');
	Route::post('support_ticket/reply', [\App\Http\Controllers\SupportTicketController::class, 'admin_store'])->name('support_ticket.admin_store');

	//Pickup_Points
	Route::resource('pick_up_points', \App\Http\Controllers\PickupPointController::class)->except(['destroy']);
	Route::get('/pick_up_points/destroy/{id}', [\App\Http\Controllers\PickupPointController::class, 'destroy'])->name('pick_up_points.destroy');


	Route::get('orders_by_pickup_point', [\App\Http\Controllers\OrderController::class, 'order_index'])->name('pick_up_point.order_index');
	Route::get('/orders_by_pickup_point/{id}/show', [\App\Http\Controllers\OrderController::class, 'pickup_point_order_sales_show'])->name('pick_up_point.order_show');

	Route::get('invoice/admin/{order_id}', [\App\Http\Controllers\InvoiceController::class, 'admin_invoice_download'])->name('admin.invoice.download');

	//conversation of seller customer
	Route::get('conversations', [\App\Http\Controllers\ConversationController::class, 'admin_index'])->name('admin.conversations.index');
	Route::get('conversations/{id}/show', [\App\Http\Controllers\ConversationController::class, 'admin_show'])->name('admin.conversations.show');
	Route::get('/conversations/destroy/{id}', [\App\Http\Controllers\ConversationController::class, 'destroy'])->name('admin.conversations.destroy');


    Route::post('/sellers/profile_modal', [\App\Http\Controllers\SellerController::class, 'profile_modal'])->name('sellers.profile_modal');
    Route::post('/sellers/approved', [\App\Http\Controllers\SellerController::class, 'updateApproved'])->name('sellers.approved');

    Route::post('/sellers/approved', [\App\Http\Controllers\SellerController::class, 'updateApproved'])->name('sellers.approved');

});
