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
        Route::get('user', 'UserController@getAuthenticatedUser');
        Route::get('closed', 'DataController@closed');
        Route::post('sales/create', 'SalesController@create');
        Route::get('sales/{id}', 'SalesController@find');
        Route::get('sales','SalesController@all');
        Route::post('sales/{id}','SalesController@update');
        Route::get('sales/detail/{id}','SalesController@getProduct');
        Route::get('product','ProductController@all');
        Route::get('proposal/{id}','SalesController@showAllData');
        Route::get('product/{id}','ProductController@getItem');
        Route::post('product/{id}','ProductController@update');
    });

 
