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
    return view('welcome');
});

Route::group(['prefix' => 'userbuy'], function () {
  Route::get('/login', 'UserbuyAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'UserbuyAuth\LoginController@login');
  Route::post('/logout', 'UserbuyAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'UserbuyAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'UserbuyAuth\RegisterController@register');

  Route::post('/password/email', 'UserbuyAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'UserbuyAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'UserbuyAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'UserbuyAuth\ResetPasswordController@showResetForm');
});
