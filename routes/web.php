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

Route::get('/', function () {
    return view('auth-admin.loginForm');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', function (){
    return view('auth-admin.login');
})->name('admin.getLogin');

/*Route::get('/loginFormTemplate', function (){
   return view('loginForm');
});*/


Route::group(['prefix' => 'admin'], function (){
    Route::get('dashboard', 'Admin\DashboardController@index')->name('index');
   /* Route::get('login', 'Admin\AuthController@getLogin')->name('admin.getLogin');*/
    Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');


    Route::get('userlist', 'BackOffice\UserController@index')->name('userlist.index');
    Route::get('sellerlist', 'BackOffice\SellerController@index')->name('sellerlist.index');
    Route::get('report', 'BackOffice\ReportController@index')->name('report.index');
    Route::get('print', 'BackOffice\ReportController@print')->name('report.print');


    Route::get('getlogin', 'Admin\AuthController@getLogin')->name('admin.getLogin');
    Route::post('login', 'Admin\AuthController@login')->name('admin.login.submit');
});


Route::group(['prefix' => 'seller'], function (){
    Route::get('password/reset', 'v1\Seller\Auth\ResetPasswordController@showResetForm')->name('seller.password.request');
    Route::post('password/reset', 'v1\Seller\Auth\ResetPasswordController@reset')->name('seller.password.update');
});

Route::group(['prefix' => 'user'], function (){
    Route::get('password/reset', 'v1\User\Auth\ResetPasswordController@showResetForm')->name('buyer.password.request');
    Route::post('password/reset', 'v1\User\Auth\ResetPasswordController@reset')->name('buyer.password.update');
});