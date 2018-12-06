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

Auth::routes();

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/account', 'Frontend\AccountController@index')->name('account');
Route::put('/account/update', 'Frontend\AccountController@update')->name('account.update');

Route::get('/cart/index', 'Frontend\CartController@index')->name('cart.index');
Route::get('/cart/create/{product}', 'Frontend\CartController@create')->name('cart.create');
Route::get('/cart/destroy/{id}', 'Frontend\CartController@destroy')->name('cart.destroy');
Route::put('/cart/update/{id}', 'Frontend\CartController@update')->name('cart.update');
Route::get('/cart/empty', 'Frontend\CartController@empty')->name('cart.empty');
Route::get('/cart/checkout', 'Frontend\CartController@checkout')->name('cart.checkout');

Route::get('order/sales', 'Frontend\OrderController@sales')->name('order.sales');
Route::resource('order', 'Frontend\OrderController');

Route::resource('product', 'Frontend\ProductController');
Route::get('/myproduct', 'Frontend\ProductController@myproduct')->name('product.my');

Route::resource('shop', 'Frontend\ShopController');
Route::resource('address', 'Frontend\AddressController');
Route::put('address/setmain/{address}', 'Frontend\AddressController@set_main_address')->name('address.set_main_address');

Route::delete('/image/destroy/{image}', 'Frontend\ImageController@destroy')->name('image.destroy');

Route::get('/admin', 'Admin\DashboardController@index')->name('dashboard.index');
Route::get('/admin/general', 'Admin\GeneralSettingsController@index')->name('admin.generalsetting');
Route::put('/admin/general/update/{generalsetting}', 'Admin\GeneralSettingsController@update')->name('admin.generalsetting.update');

Route::get('/admin/localization', 'Admin\LocalizationSettingsController@index')->name('admin.localizationsetting');
Route::put('/admin/localization/update/{localizationsetting}', 'Admin\LocalizationSettingsController@update')->name('admin.localizationsetting.update');

Route::resource('admin/category', 'Admin\CategoryController');
Route::get('/home', 'HomeController@index')->name('home');

// Axios AJAX call
Route::get('/address-api', 'API\AddressApiController@index');
Route::get('/address-api/search/{searchQuery}', 'API\AddressApiController@search');
Route::get('/address-api/byid/{address}', 'API\AddressApiController@getAddressById');
Route::get('/address-api/mainaddress', 'API\AddressApiController@getMainAddress');