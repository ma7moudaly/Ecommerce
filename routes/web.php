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


/*Start of FrontEnd */
Route::get('/', [
    'uses' => 'FrontEndController@index',
    'as'   => 'index'
]);

Route::get('/product/{id}',[
    'uses' => 'FrontEndController@singleProduct',
    'as'   => 'product.single' 
]);

Route::post('/cart/add',[
    'uses' => 'ShoopingController@add_to_cart',
    'as'   => 'cart.add'
]);

Route::get('/cart',[
    'uses' => 'ShoopingController@cart',
    'as'   => 'cart'
]);

Route::get('/cart/delete/{id}',[
    'uses' => 'ShoopingController@cart_delete',
    'as'   => 'cart.delete' 
]);

Route::get('/cart/incr/{id}/{qty}',[
    'uses' => 'shoopingController@incr',
    'as'   => 'cart.incr'
]);

Route::get('/cart/decr/{id}/{qty}',[
    'uses' => 'shoopingController@decr',
    'as'   => 'cart.decr'
]);

Route::get('/cart/rapid/add/{id}',[
    'uses' => 'shoopingController@rapid_add',
    'as'   => 'cart.rapid.add'
]);

Route::get('/cart/checkout',[
    'uses' => 'CheckoutController@index',
    'as'   => 'cart.checkout'
]);

Route::post('/cart/checkout',[
    'uses' => 'CheckoutController@pay',
    'as'   => 'cart.checkout'
]);
/*End of FrontEnd */

/* Start of Authentication Routes */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/* End of Authentication Routes */

/*Start of CRUD for table Product */
Route::resource('products','ProductsController');
/*End of CRUD for table Product */