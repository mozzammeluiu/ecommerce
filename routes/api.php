<?php

use Illuminate\Http\Request;

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

//Login And Resister with JSON Web Token(JWT)
Route::post('register', [\App\Http\Controllers\API\UserApiController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\UserApiController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\API\UserApiController::class, 'logout']);
Route::get('email/resend', [\App\Http\Controllers\API\VerificationController::class, 'resend'])->name('api.verification.resend');
Route::post('email/verify/{id}/{hash}', [\App\Http\Controllers\API\VerificationController::class, 'verify'])->name('api.verification.verify');
// Route::post('password/email', [\App\Http\Controllers\API\ForgotPasswordController::class, 'sendResetLinkEmail']);
// Route::post('password/reset', [\App\Http\Controllers\API\ResetPasswordController::class, 'reset']);

//User
Route::group(['middleware' => ['jwt.auth', 'mail.verified']], function(){
    Route::get('user', [\App\Http\Controllers\API\UserApiController::class, 'user']);
    Route::post('user', [\App\Http\Controllers\API\UserApiController::class, 'user_update']);
    Route::post('shipping_info', [\App\Http\Controllers\API\UserApiController::class, 'shipping_info']);
    Route::get('wishlist', [\App\Http\Controllers\API\UserApiController::class, 'wishlist']);
    Route::post('wishlist', [\App\Http\Controllers\API\UserApiController::class, 'add_wishlist']);
    Route::delete('wishlist', [\App\Http\Controllers\API\UserApiController::class, 'remove_wishlist']);
    Route::get('cart', [\App\Http\Controllers\API\UserApiController::class, 'cart']);
    Route::post('cart', [\App\Http\Controllers\API\UserApiController::class, 'add_cart']);
    Route::delete('cart', [\App\Http\Controllers\API\UserApiController::class, 'remove_cart']);

    //order list
    Route::get('/orders/all', [\App\Http\Controllers\API\UserApiController::class, 'all_orders']);
    Route::get('/orders/paid', [\App\Http\Controllers\API\UserApiController::class, 'paid_orders']);
    Route::get('/orders/unpaid', [\App\Http\Controllers\API\UserApiController::class, 'unpaid_orders']);
    Route::get('/orders/shipped', [\App\Http\Controllers\API\UserApiController::class, 'shipped_orders']);
    Route::get('/orders/pending', [\App\Http\Controllers\API\UserApiController::class, 'toBeShipped_orders']);
});

Route::get('banner', [\App\Http\Controllers\API\GeneralApiController::class, 'banner']);
Route::get('flash_sales', [\App\Http\Controllers\API\GeneralApiController::class, 'flash_sales']);
Route::get('brands', [\App\Http\Controllers\API\GeneralApiController::class, 'brands']);
Route::get('categories', [\App\Http\Controllers\API\GeneralApiController::class, 'categories']);
Route::get('sub_categories/{category_id}', [\App\Http\Controllers\API\GeneralApiController::class, 'sub_categories']);
Route::get('category/products/{category_id}', [\App\Http\Controllers\API\GeneralApiController::class, 'category_product']);
Route::get('sub_category/products/{sub_category_id}', [\App\Http\Controllers\API\GeneralApiController::class, 'sub_category_product']);
