<?php

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

Auth::routes(['verify' => true]);
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::post('/language', [\App\Http\Controllers\LanguageController::class, 'changeLanguage'])->name('language.change');
Route::post('/currency', [\App\Http\Controllers\CurrencyController::class, 'changeCurrency'])->name('currency.change');

Route::get('/social-login/redirect/{provider}', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('/social-login/{provider}/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('social.callback');
Route::get('/users/login', [\App\Http\Controllers\HomeController::class, 'login'])->name('user.login');
Route::get('/users/registration', [\App\Http\Controllers\HomeController::class, 'registration'])->name('user.registration');
//Route::post('/users/login', [\App\Http\Controllers\HomeController::class, 'user_login'])->name('user.login.submit');
Route::post('/users/login/cart', [\App\Http\Controllers\HomeController::class, 'cart_login'])->name('cart.login.submit');

Route::post('/subcategories/get_subcategories_by_category', [\App\Http\Controllers\SubCategoryController::class, 'get_subcategories_by_category'])->name('subcategories.get_subcategories_by_category');
Route::post('/subsubcategories/get_subsubcategories_by_subcategory', [\App\Http\Controllers\SubSubCategoryController::class, 'get_subsubcategories_by_subcategory'])->name('subsubcategories.get_subsubcategories_by_subcategory');
Route::post('/subsubcategories/get_brands_by_subsubcategory', [\App\Http\Controllers\SubSubCategoryController::class, 'get_brands_by_subsubcategory'])->name('subsubcategories.get_brands_by_subsubcategory');

//Home Page
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home/section/featured', [\App\Http\Controllers\HomeController::class, 'load_featured_section'])->name('home.section.featured');
Route::post('/home/section/best_selling', [\App\Http\Controllers\HomeController::class, 'load_best_selling_section'])->name('home.section.best_selling');
Route::post('/home/section/home_categories', [\App\Http\Controllers\HomeController::class, 'load_home_categories_section'])->name('home.section.home_categories');
Route::post('/home/section/best_sellers', [\App\Http\Controllers\HomeController::class, 'load_best_sellers_section'])->name('home.section.best_sellers');
//category dropdown menu ajax call
Route::post('/category/nav-element-list', [\App\Http\Controllers\HomeController::class, 'get_category_items'])->name('category.elements');

//Flash Deal Details Page
Route::get('/flash-deal/{slug}', [\App\Http\Controllers\HomeController::class, 'flash_deal_details'])->name('flash-deal-details');

Route::get('/sitemap.xml', function(){
	return base_path('sitemap.xml');
});



Route::get('/product/{slug}', [\App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/products', [\App\Http\Controllers\HomeController::class, 'listing'])->name('products');
Route::get('/search?category={category_slug}', [\App\Http\Controllers\HomeController::class, 'search'])->name('products.category');
Route::get('/search?subcategory={subcategory_slug}', [\App\Http\Controllers\HomeController::class, 'search'])->name('products.subcategory');
Route::get('/search?subsubcategory={subsubcategory_slug}', [\App\Http\Controllers\HomeController::class, 'search'])->name('products.subsubcategory');
Route::get('/search?brand={brand_slug}', [\App\Http\Controllers\HomeController::class, 'search'])->name('products.brand');
Route::post('/product/variant_price', [\App\Http\Controllers\HomeController::class, 'variant_price'])->name('products.variant_price');
Route::get('/shops/visit/{slug}', [\App\Http\Controllers\HomeController::class, 'shop'])->name('shop.visit');
Route::get('/shops/visit/{slug}/{type}', [\App\Http\Controllers\HomeController::class, 'filter_shop'])->name('shop.visit.type');

Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart/nav-cart-items', [\App\Http\Controllers\CartController::class, 'updateNavCart'])->name('cart.nav_cart');
Route::post('/cart/show-cart-modal', [\App\Http\Controllers\CartController::class, 'showCartModal'])->name('cart.showCartModal');
Route::post('/cart/addtocart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.addToCart');
Route::post('/cart/removeFromCart', [\App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::post('/cart/updateQuantity', [\App\Http\Controllers\CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

//Checkout Routes
Route::group(['middleware' => ['checkout']], function(){
	Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'get_shipping_info'])->name('checkout.shipping_info');
	Route::any('/checkout/delivery_info', [\App\Http\Controllers\CheckoutController::class, 'store_shipping_info'])->name('checkout.store_shipping_infostore');
	Route::post('/checkout/payment_select', [\App\Http\Controllers\CheckoutController::class, 'store_delivery_info'])->name('checkout.store_delivery_info');
});

Route::post('/checkout/payment', [\App\Http\Controllers\CheckoutController::class, 'checkout'])->name('payment.checkout');
Route::post('/get_pick_ip_points', [\App\Http\Controllers\HomeController::class, 'get_pick_ip_points'])->name('shipping_info.get_pick_ip_points');
Route::get('/checkout/payment_select', [\App\Http\Controllers\CheckoutController::class, 'get_payment_info'])->name('checkout.payment_info');
Route::post('/checkout/apply_coupon_code', [\App\Http\Controllers\CheckoutController::class, 'apply_coupon_code'])->name('checkout.apply_coupon_code');
Route::post('/checkout/remove_coupon_code', [\App\Http\Controllers\CheckoutController::class, 'remove_coupon_code'])->name('checkout.remove_coupon_code');

//Paypal START
Route::get('/paypal/payment/done', [\App\Http\Controllers\PaypalController::class, 'getDone'])->name('payment.done');
Route::get('/paypal/payment/cancel', [\App\Http\Controllers\PaypalController::class, 'getCancel'])->name('payment.cancel');
//Paypal END

// SSLCOMMERZ Start
Route::get('/sslcommerz/pay', [\App\Http\Controllers\PublicSslCommerzPaymentController::class, 'index']);
Route::POST('/sslcommerz/success', [\App\Http\Controllers\PublicSslCommerzPaymentController::class, 'success']);
Route::POST('/sslcommerz/fail', [\App\Http\Controllers\PublicSslCommerzPaymentController::class, 'fail']);
Route::POST('/sslcommerz/cancel', [\App\Http\Controllers\PublicSslCommerzPaymentController::class, 'cancel']);
Route::POST('/sslcommerz/ipn', [\App\Http\Controllers\PublicSslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//Stipe Start
Route::get('stripe', [\App\Http\Controllers\StripePaymentController::class, 'stripe']);
Route::post('stripe', [\App\Http\Controllers\StripePaymentController::class, 'stripePost'])->name('stripe.post');
//Stripe END

Route::get('/compare', [\App\Http\Controllers\CompareController::class, 'index'])->name('compare');
Route::get('/compare/reset', [\App\Http\Controllers\CompareController::class, 'reset'])->name('compare.reset');
Route::post('/compare/addToCompare', [\App\Http\Controllers\CompareController::class, 'addToCompare'])->name('compare.addToCompare');

Route::resource('subscribers', \App\Http\Controllers\SubscriberController::class);

Route::get('/brands', [\App\Http\Controllers\HomeController::class, 'all_brands'])->name('brands.all');
Route::get('/categories', [\App\Http\Controllers\HomeController::class, 'all_categories'])->name('categories.all');
Route::get('/search', [\App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/search?q={search}', [\App\Http\Controllers\HomeController::class, 'search'])->name('suggestion.search');
Route::post('/ajax-search', [\App\Http\Controllers\HomeController::class, 'ajax_search'])->name('search.ajax');
Route::post('/config_content', [\App\Http\Controllers\HomeController::class, 'product_content'])->name('configs.update_status');

Route::get('/sellerpolicy', [\App\Http\Controllers\HomeController::class, 'sellerpolicy'])->name('sellerpolicy');
Route::get('/returnpolicy', [\App\Http\Controllers\HomeController::class, 'returnpolicy'])->name('returnpolicy');
Route::get('/supportpolicy', [\App\Http\Controllers\HomeController::class, 'supportpolicy'])->name('supportpolicy');
Route::get('/terms', [\App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
Route::get('/privacypolicy', [\App\Http\Controllers\HomeController::class, 'privacypolicy'])->name('privacypolicy');

Route::group(['middleware' => ['user', 'verified']], function(){
	Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
	Route::get('/profile', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
	Route::post('/customer/update-profile', [\App\Http\Controllers\HomeController::class, 'customer_update_profile'])->name('customer.profile.update');
	Route::post('/seller/update-profile', [\App\Http\Controllers\HomeController::class, 'seller_update_profile'])->name('seller.profile.update');

	Route::resource('purchase_history', \App\Http\Controllers\PurchaseHistoryController::class)->except(['destroy']);
	Route::post('/purchase_history/details', [\App\Http\Controllers\PurchaseHistoryController::class, 'purchase_history_details'])->name('purchase_history.details');
	Route::get('/purchase_history/destroy/{id}', [\App\Http\Controllers\PurchaseHistoryController::class, 'destroy'])->name('purchase_history.destroy');

	Route::resource('wishlists', \App\Http\Controllers\WishlistController::class);
	Route::post('/wishlists/remove', [\App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlists.remove');

	Route::get('/wallet', [\App\Http\Controllers\WalletController::class, 'index'])->name('wallet.index');
	Route::post('/recharge', [\App\Http\Controllers\WalletController::class, 'recharge'])->name('wallet.recharge');

	Route::resource('support_ticket', \App\Http\Controllers\SupportTicketController::class);
	Route::post('support_ticket/reply', [\App\Http\Controllers\SupportTicketController::class, 'seller_store'])->name('support_ticket.seller_store');
});

Route::group(['prefix' =>'seller', 'middleware' => ['seller', 'verified']], function(){
	Route::get('/products', [\App\Http\Controllers\HomeController::class, 'seller_product_list'])->name('seller.products');
	Route::get('/product/upload', [\App\Http\Controllers\HomeController::class, 'show_product_upload_form'])->name('seller.products.upload');
	Route::get('/product/{id}/edit', [\App\Http\Controllers\HomeController::class, 'show_product_edit_form'])->name('seller.products.edit');
	Route::resource('payments', \App\Http\Controllers\PaymentController::class);

	Route::get('/shop/apply_for_verification', [\App\Http\Controllers\ShopController::class, 'verify_form'])->name('shop.verify');
	Route::post('/shop/apply_for_verification', [\App\Http\Controllers\ShopController::class, 'verify_form_store'])->name('shop.verify.store');

	Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'seller_reviews'])->name('reviews.seller');
});

Route::group(['middleware' => ['auth']], function(){
	Route::post('/products/store/', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
	Route::post('/products/update/{id}', [\App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
	Route::get('/products/destroy/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
	Route::get('/products/duplicate/{id}', [\App\Http\Controllers\ProductController::class, 'duplicate'])->name('products.duplicate');
	Route::post('/products/sku_combination', [\App\Http\Controllers\ProductController::class, 'sku_combination'])->name('products.sku_combination');
	Route::post('/products/sku_combination_edit', [\App\Http\Controllers\ProductController::class, 'sku_combination_edit'])->name('products.sku_combination_edit');
	Route::post('/products/featured', [\App\Http\Controllers\ProductController::class, 'updateFeatured'])->name('products.featured');
	Route::post('/products/published', [\App\Http\Controllers\ProductController::class, 'updatePublished'])->name('products.published');

	Route::get('invoice/customer/{order_id}', [\App\Http\Controllers\InvoiceController::class, 'customer_invoice_download'])->name('customer.invoice.download');
	Route::get('invoice/seller/{order_id}', [\App\Http\Controllers\InvoiceController::class, 'seller_invoice_download'])->name('seller.invoice.download');

	Route::resource('orders', \App\Http\Controllers\OrderController::class)->except(['destroy']);
	Route::get('/orders/destroy/{id}', [\App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');
	Route::post('/orders/details', [\App\Http\Controllers\OrderController::class, 'order_details'])->name('orders.details');
	Route::post('/orders/update_delivery_status', [\App\Http\Controllers\OrderController::class, 'update_delivery_status'])->name('orders.update_delivery_status');
	Route::post('/orders/update_payment_status', [\App\Http\Controllers\OrderController::class, 'update_payment_status'])->name('orders.update_payment_status');

	Route::resource('/reviews', \App\Http\Controllers\ReviewController::class);

	Route::resource('/withdraw_requests', \App\Http\Controllers\SellerWithdrawRequestController::class);
	Route::get('/withdraw_requests_all', [\App\Http\Controllers\SellerWithdrawRequestController::class, 'request_index'])->name('withdraw_requests_all');
	Route::post('/withdraw_request/payment_modal', [\App\Http\Controllers\SellerWithdrawRequestController::class, 'payment_modal'])->name('withdraw_request.payment_modal');
	Route::post('/withdraw_request/message_modal', [\App\Http\Controllers\SellerWithdrawRequestController::class, 'message_modal'])->name('withdraw_request.message_modal');

	Route::resource('conversations', \App\Http\Controllers\ConversationController::class);
	Route::post('conversations/refresh', [\App\Http\Controllers\ConversationController::class, 'refresh'])->name('conversations.refresh');
	Route::resource('messages', \App\Http\Controllers\MessageController::class);
});

Route::resource('shops', \App\Http\Controllers\ShopController::class);
Route::get('/track_your_order', [\App\Http\Controllers\HomeController::class, 'trackOrder'])->name('orders.track');

Route::get('/instamojo/payment/pay-success', [\App\Http\Controllers\InstamojoController::class, 'success'])->name('instamojo.success');

Route::post('rozer/payment/pay-success', [\App\Http\Controllers\RazorpayController::class, 'payment'])->name('payment.rozer');

Route::get('/paystack/payment/callback', [\App\Http\Controllers\PaystackController::class, 'handleGatewayCallback']);


Route::get('/vogue-pay', [\App\Http\Controllers\VoguePayController::class, 'showForm']);
Route::get('/vogue-pay/success/{id}', [\App\Http\Controllers\VoguePayController::class, 'paymentSuccess']);
Route::get('/vogue-pay/failure/{id}', [\App\Http\Controllers\VoguePayController::class, 'paymentFailure']);

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

