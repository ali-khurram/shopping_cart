<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@index');

Route::get('/add/{product_id}', 'CartController@addItem');

Route::group(array('prefix' => '/basket'), function() {
    
    Route::get('/{order_id}', 'CartController@showBasket');
    
    Route::post('/update', 'CartController@updateBasket');
    
    Route::get('/delete/{order_id}/{product_id}', 'CartController@deleteProduct');
    
    Route::post('/voucher', 'VoucherController@addVoucher');
    
    Route::post('/checkout', 'CartController@checkout');
});

Route::get('/voucher', function(){
    $v = Category::all();
    foreach($v as $code) {
        var_dump($code->name);
    }
});
