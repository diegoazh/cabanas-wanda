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


// No olvidar hacer pasar las peticiones por el middleware jwt.auth

Route::get('query', 'RentalsController@queryForCapacityAndDate')->name('api.rentals.index');
