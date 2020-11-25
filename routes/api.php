<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::get('verify/{id}', 'v1\VerificationEmailController@verify')->name('api.verification.verify');

//seller
Route::group(['prefix' => 'seller'], function(){
    Route::post('register', 'v1\Seller\Auth\RegisterController@register');
    Route::post('login', 'v1\Seller\Auth\LoginController@login');
    Route::post('password/email', 'v1\Seller\Auth\ForgotPasswordController@sendResetLinkEmail')->name('seller.password.email');

    Route::get('profile', 'v1\Seller\ProfileController@profile');
    Route::post('profile/update', 'v1\Seller\ProfileController@updateProfile');
    Route::post('profile/update/photo', 'v1\Seller\ProfileController@updatePhoto');
    Route::post('profile/update/password', 'v1\Seller\ProfileController@updatePassword');
    Route::get('verify/{id}', 'v1\Seller\Auth\VerificationController@verify')->name('seller.verification.verify');

    Route::post('product/store','v1\Seller\ProductController@store');
    Route::post('product/{id}/update','v1\Seller\ProductController@update');
    Route::post('product/{id}/update/photo','v1\Seller\ProductController@updatePhoto');
    Route::get('product/{id}/delete','v1\Seller\ProductController@delete');
    Route::get('product/{id}/find','v1\Seller\ProductController@find');
    Route::get('product/show','v1\Seller\ProductController@show');

    Route::get('order/orderin','v1\Seller\OrderController@sellerOrderIn');
    Route::get('order/inprogress','v1\Seller\OrderController@sellerInProgress');
    //Route::get('order/completed', 'v1\Seller\OrderController@sellerCompleted');
    Route::get('order/complete', 'v1\Seller\OrderController@sellerComplete');

    Route::get('order/{id}/decline','v1\Seller\OrderController@decline');
    Route::get('order/{id}/confirmed','v1\Seller\OrderController@confirmed');
    Route::get('order/{id}/completed', 'v1\Seller\OrderController@completed');

    Route::get('subdistrict', 'v1\Seller\SubdistrictController@index');
    Route::get('fruit', 'v1\Seller\FruitController@index');

});

//user
Route::group(['prefix' => 'user'], function(){
    Route::post('register', 'v1\User\Auth\RegisterController@register');
    Route::post('login', 'v1\User\Auth\LoginController@login');
    Route::post('password/email', 'v1\User\Auth\ForgotPasswordController@sendResetLinkEmail')->name('buyer.password.email');

    Route::get('profile', 'v1\User\ProfileController@profile');
    Route::post('profile/update', 'v1\User\ProfileController@updateProfile');
    Route::post('profile/update/photo', 'v1\User\ProfileController@updatePhoto');
    Route::post('profile/update/password', 'v1\User\ProfileController@updatePassword');
    Route::get('verify/{id}', 'v1\User\Auth\VerificationController@verify')->name('user.verification.verify');


    Route::get('subdistrict', 'v1\User\SubDistrictController@index');
    Route::get('fruit/{sub_district_id}', 'v1\User\FruitController@fetchFruitBySubDistrict');

    Route::get('product','v1\User\ProductController@index');
    Route::get('product/{sub_district_id}','v1\User\ProductController@fetchProductBySubDistrict');
    Route::post('product/search','v1\User\ProductController@allByCriteria');
    Route::get('product/{name}/search','v1\User\ProductController@search');

    Route::post('order/store','v1\User\OrderController@store');

    Route::get('order/{id}/decline','v1\User\OrderController@decline');
    Route::get('order/{id}/arrived', 'v1\User\OrderController@arrived');

    Route::get('order/waiting','v1\User\OrderController@userWaiting');
    Route::get('order/inprogress','v1\User\OrderController@userInProgress');
    Route::get('order/complete','v1\User\OrderController@userComplete');

});