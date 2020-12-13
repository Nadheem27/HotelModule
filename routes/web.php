<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => true, 'reset' => false, 'verify' => false, 'logout' =>false]);

Route::get('/home', function() {
    return redirect('/dashboard');
});

Route::get('/hotel-login', 'HotelController@check');
Route::post('/new-user', 'UserController@register');
Route::post('/email-check', 'UserController@email');
Route::post('/phone-check', 'UserController@phone');
Route::post('/hotel-login-access', 'HotelController@index');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'UserController@index');
    Route::get('/dashboard', 'UserController@index');
    Route::get('/logout', 'UserController@logout');
    Route::post('/get-room', 'UserController@room');
    Route::post('/book-room', 'UserController@book');
});

Route::group(['middleware' => 'hotel'], function() {
    Route::get('/hotel-dashboard', 'HotelController@table');
    Route::get('/hotel-logout', 'HotelController@logout');
    Route::post('/new-room', 'HotelController@newroom');
    Route::get('/availablity-check', 'HotelController@availablity');
    Route::post('/room-availability', 'HotelController@newavail');
});
