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
Route::group(['prefix' => 'AYLJAPANEL'], function () {

    Auth::routes();

    /*Custom Login*/
    Route::post('login','AdminController@login')->name('admin.login');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('home');
        // Route::resource('user', 'UserController', ['except' => ['show']]);
        Route::resource('admin', 'AdminController');
        Route::resource('category', 'CategoryController');
        Route::resource('subCategory', 'SubCategoryController');
        Route::resource('buyer', 'BuyerController');
        Route::resource('vendor', 'VendorController');
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    });

});
