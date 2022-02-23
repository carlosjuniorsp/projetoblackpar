<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dasboard', function () {
    return view('menu');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/dashboard', 'App\Http\Controllers\UserController@login')->name('dashboard');
Route::post('user/register', 'App\Http\Controllers\UserController@create')->name('register');