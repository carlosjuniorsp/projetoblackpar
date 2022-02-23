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
Route::post('register', 'App\Http\Controllers\UserController@create')->name('register');
Route::get('/list/{id}', 'App\Http\Controllers\UserController@list')->name('list');
Route::post('/edit/{id}', 'App\Http\Controllers\UserController@update')->name('edit');
Route::get('/list-user', 'App\Http\Controllers\UserController@show');