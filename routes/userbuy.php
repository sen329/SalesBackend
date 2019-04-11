<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('userbuy')->user();

    //dd($users);

    return view('userbuy.home');
})->name('home');

