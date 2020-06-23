<?php

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
Route::get('/', function () {

    return redirect('AYLJAPANEL');
});
Route::get('filter', 'VendorController@index');
Route::group(['prefix' => 'AYLJAPANEL'], function () {

    Auth::routes();

    /*Custom Login*/
    Route::post('login', 'AdminController@login')->name('admin.login');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', 'HomeController@index')->name('home');
        // Route::resource('user', 'UserController', ['except' => ['show']]);
        Route::resource('category', 'CategoryController');
        Route::resource('subCategory', 'SubCategoryController');
        Route::resource('buyer', 'BuyerController');
        Route::resource('vendor', 'VendorController');
        Route::put('vendorUpdateStatus/{vendor}', 'VendorController@updateStatus')->name('vendor.updateStatus');

        Route::resource('coupon', 'CouponController');

        Route::put('updateStatus/{coupon}', 'CouponController@updateStatus')->name('coupon.updateStatus');
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

        //Settings
        Route::group(['prefix' => 'settings'], function () {
            Route::resource('admin', 'AdminController');
            Route::resource('apiKey', 'ApiKeyController');
            Route::resource('blog', 'BlogController');
            Route::resource('privacyAndPolicy', 'PrivacyAndPolicyController');
            Route::resource('termAndCondition', 'TermAndConditionController');

        });

        //Reports
        Route::group(['prefix' => 'reports'], function () {
            Route::resource('vendorsReport', 'VendorReportController');
            Route::resource('awufulReferralVendorsReport', 'AwufulReferralVendorReportController');
            Route::resource('buyersReport', 'BuyerReportController');
            Route::resource('awufulReferralBuyersReport', 'AwufulReferralBuyerReportController');
            Route::resource('blogsReport', 'BlogReportController');
            Route::resource('salesReport', 'SalesReportController');
        });
    });

});
/*Ajax Routes*/
Route::group(['prefix' => 'ajax', 'middleware' => ['auth:admin']], function () {
    Route::get('subCategories/{categoryId}', 'SubCategoryController@subCategories')->name('filter.subcategory');
});
