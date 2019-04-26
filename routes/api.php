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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('sales/register', 'UserController@register');
    Route::post('sales/login', 'UserController@authenticate');
Route::post('buy/register', 'UserBuyController@register');
    Route::post('buy/login','UserBuyController@authenticate');
    Route::get('open', 'DataController@open');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('sales/create', 'OrderDetailController@create');
        Route::get('sales/{id}', 'OrderDetailController@find');
        Route::get('sales','OrderDetailController@all');
        Route::get('sales/detail/{id}','SalesController@getProduct');
        Route::get('product','ProductController@all');
        Route::get('proposal/{id}','OrderDetailController@getAllData');
        Route::get('product/{id}','ProductController@getItem');
        Route::post('product/create','ProductController@create');
        Route::get('sales/mysales/{id}','SalesController@mySales');
        Route::post('sales/order/stat','OrderDetailController@update');
        Route::post('product/{id}','ProductController@update');
        Route::get('sales/search/id/{id}','SalesController@findByID');
        Route::get('sales/search/name/{name}','SalesController@findByName');
        Route::get('sales/order/{sales_id}','OrderDetailController@salesOrder');
        Route::post('upload','ProductController@uploadExcel');
    });
