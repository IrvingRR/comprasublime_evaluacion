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
/* Web */
Route::get('/', 'ContentController@getHome')->name('home');
Route::get('/store', 'ContentController@getStore')->name('store');
Route::get('/aboutUs', 'ContentController@getAboutUs')->name('aboutUs');
Route::get('/contact', 'ContentController@getContact')->name('contact');

/* Store */
Route::post('/store/search', 'StoreController@postProductSearch')->name("store_search");
Route::get('/store/category/{id}/{slug}', 'StoreController@getProductsCategory')->name("store_category_products");

/* Module product */ 
Route::get('/product/{id}/{slug}', 'ProductController@getProduct')->name('product');

/* Router authentication*/
Route::get('/login', 'ConnectController@getLogin')->name('login');
Route::post('/login', 'ConnectController@postLogin')->name('login');
Route::get('/register', 'ConnectController@getRegister')->name('register');
Route::post('/register', 'ConnectController@postRegister')->name('register');
Route::get('/logout', 'ConnectController@getLogout')->name('logout');


// RECOVER PASSWORD
Route::get('/recover', 'ConnectController@getRecover')->name('recover');
Route::post('/recover', 'ConnectController@postRecover')->name('recover');
Route::get('/reset', 'ConnectController@getReset')->name('reset');
Route::post('/reset', 'ConnectController@postReset')->name('reset');


// Middle User Actions
Route::get('/account/edit', 'UserController@getAccountEdit')->name('account_edit');
Route::post('/account/edit/avatar', 'UserController@postAccountAvatar')->name('account_avatar_edit');
Route::post('/account/edit/password', 'UserController@postAccountPassword')->name('account_password_edit');
Route::post('/account/edit/info', 'UserController@postAccountInfo')->name('account_info_edit');
Route::get('/account/favorites/{id}', 'UserController@getFavorites')->name('account_favorites');
Route::get('/account/favorites/delete/{id}', 'UserController@getDeleteFavorite')->name('delete_favorite');
Route::get('/account/car/{id}', 'UserController@getCarProducts')->name('account_car');
Route::get('/account/car/delete/{id}', 'UserController@getDeleteCarProduct')->name('account_car_delete');
Route::get('/account/orders/{id}', 'UserController@getOrdersView')->name('orders');
Route::get('/account/orders/user/{id}', 'UserController@getOrdersUser')->name('orders');
Route::post('/account/orders/user/edit/{id_order}/{new_direction}', 'UserController@postEditOrderDirection');
Route::get('/account/orders/user/delete/{id_order}', 'UserController@getDeleteOrder');
Route::get('/account/orders/user/paid_now/{id_order}', 'UserController@getPaidNowOrder');




// Ajax Api Routers
Route::get('/md/api/load/products/{section}', 'ApiJsController@getProductsSection');
Route::post('/md/api/load/user/favorites', 'ApiJsController@postUserFavorites');
Route::post('/md/api/favorites/add/{object}/{module}', 'ApiJsController@postFavoriteAdd');
Route::post('/md/api/car/add/{object}/{module}', 'ApiJsController@postCarAdd');
Route::get('/md/api/car/products/{id}', 'ApiJsController@getCarUserProducts');
Route::post('/md/api/orders/add/{id_user}/{module}/{total}/{cantidad}/{direction}/{paid_out}', 'ApiJsController@postOrdersAdd');
Route::get('/md/api/car/delete_all/{id_user}', 'ApiJsController@getDeleteAllCarProducts');
Route::post('/messages/user/send/{name}/{lastname}/{email}/{mensaje}', 'ApiJsController@postSendMessage');
