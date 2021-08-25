<?php

Route::prefix('/admin')->group(function(){
    Route::get('/', 'Admin\DashboardController@getDashboard')->name("dashboard");

    //Module Settings
    Route::get('/settings', 'Admin\SettingsController@getHome')->name("settings");
    Route::post('/settings', 'Admin\SettingsController@postHome')->name("settings");

    // Moduo users
    Route::get('/users/{status}', 'Admin\UserController@getUsers')->name("user_list");
    Route::get('/user/{id}/edit', 'Admin\UserController@getUserEdit')->name("user_edit");
    Route::post('/user/{id}/edit', 'Admin\UserController@postUserEdit')->name("user_edit");
    Route::get('/user/{id}/banned', 'Admin\UserController@getUserBanned')->name("user_banned");
    Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');
    Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');
 
    // Modulo products

    Route::get('/products/{status}', 'Admin\ProductController@getHome')->name("products");
    Route::get('/product/add', 'Admin\ProductController@getProductAdd')->name("products_add");
    Route::post('/product/add', 'Admin\ProductController@postProductAdd')->name("products_add");
    Route::post('/product/search', 'Admin\ProductController@postProductSearch')->name("product_search");
    Route::get('/products/{id}/edit', 'Admin\ProductController@getProductEdit')->name("products_edit");
    Route::post('/products/{id}/edit', 'Admin\ProductController@postProductEdit')->name("products_edit");
    Route::get('/products/{id}/delete', 'Admin\ProductController@getProductDelete')->name("products_delete");
    Route::get('/products/{id}/restore', 'Admin\ProductController@getProductRestore')->name("products_delete");
    Route::post('/products/{id}/gallery/add', 'Admin\ProductController@postProductGalleryAdd')->name("products_gallery_add");
    Route::get('/products/{id}/gallery/{gid}/delete', 'Admin\ProductController@getProductGalleryDelete')->name("products_gallery_delete");
 

    // Modulo Categorias 
    Route::get('/categories/{section}', 'Admin\CategoriesController@getHome')->name("categories");
    Route::post('/category/add/{section}', 'Admin\CategoriesController@postCategoryAdd')->name("categories_add");
    Route::get('/category/{id}/edit', 'Admin\CategoriesController@getCategoryEdit')->name("categories_edit");
    Route::post('/category/{id}/edit', 'Admin\CategoriesController@postCategoryEdit')->name("categories_edit");
    Route::get('/category/{id}/subs', 'Admin\CategoriesController@getSubCategories')->name("categories_edit");
    Route::get('/category/{id}/delete', 'Admin\CategoriesController@getCategoryDelete')->name("categories_delete");
    
    
    // Modulo Sliders
    Route::get('/sliders', 'Admin\SliderController@getHome')->name('sliders_list');
    Route::post('/slider/add', 'Admin\SliderController@postSliderAdd')->name('slider_add');
    Route::get('/slider/{id}/edit', 'Admin\SliderController@getSliderEdit')->name('slider_edit');
    Route::post('/slider/{id}/edit', 'Admin\SliderController@postSliderEdit')->name('slider_edit');
    Route::get('/slider/{id}/delete', 'Admin\SliderController@getSliderDelete')->name('slider_delete');
    
    
    // Modulo Orders
    Route::get('/orders', 'Admin\OrderController@getHome')->name('orders_list');
    Route::get('/order/{id}/delete', 'Admin\OrderController@getOrderDelete')->name("orders_delete");
    
    
    // Modulo Messages
    Route::get('/messages', 'Admin\MessageController@getHome')->name('messages_list');
    Route::get('/message/{id}/delete', 'Admin\MessageController@getMessageDelete')->name("messages_delete");
});

?>
