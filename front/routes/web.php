<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('verifyLogin');

Route::get('/dasboard', function () {
    return view('menu');
})->middleware('verifyLogin');

Route::get('/register', function () {
    return view('register');
})->middleware('verifyLogin');

Route::get('/search', function () {
    return view('search');
})->middleware('verifyLogin');

Route::get('/list-user', 'App\Http\Controllers\UserController@show');
Route::post('/login', 'App\Http\Controllers\UserController@login')->name('login');
Route::post('register', 'App\Http\Controllers\UserController@create')->name('register');
Route::get('/list/{id}', 'App\Http\Controllers\UserController@list')->name('list');
Route::post('/edit/{id}', 'App\Http\Controllers\UserController@update')->name('edit');
Route::get('/delete/{id}', 'App\Http\Controllers\UserController@delete')->name('delete');
Route::post('/search-api', 'App\Http\Controllers\SearchController@search')->name('search-api');
Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');