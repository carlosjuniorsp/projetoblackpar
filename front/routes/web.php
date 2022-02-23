<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dasboard', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('user/login', 'App\Http\Controllers\UserController@login')->name('login');
Route::post('user/register', 'App\Http\Controllers\UserController@create')->name('register');