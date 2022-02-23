<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});


Route::post('user/login', 'App\Http\Controllers\UserController@login')->name('login');