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
Route::prefix('rentals')->group(function () {
    Route::get('basic', 'RentalsController@basicInfo')->name('api.rentals.basic');
    Route::post('capacity', 'RentalsController@forCapacity')->name('api.rentals.capacity');
    Route::post('cottage', 'RentalsController@forCottages')->name('api.rentals.cottage');
    Route::post('auth', 'RentalsController@authenticate')->name('api.rentals.auth');

    Route::middleware(['jwt.auth'])->group(function () {
        Route::post('store', 'RentalsController@store')->name('api.rentals.store');
    });
});