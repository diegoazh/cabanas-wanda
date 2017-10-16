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
    Route::post('availables', 'RentalsController@cottagesAvailables')->name('api.rentals.availabels');
    Route::post('auth', 'RentalsController@authenticate')->name('api.rentals.auth');

    Route::middleware(['jwt.auth', 'jwt.refresh'])->group(function () {
        Route::post('store', 'RentalsController@store')->name('api.rentals.store');
    });
});

Route::prefix('food')->group(function () {
    Route::get('all', 'Administration\ComidasController@all')->name('api.food.all');

    Route::middleware(['jwt.auth', 'jwt.refresh'])->group(function () {
        Route::post('store', 'Administration\ComidasController@store')->name('api.food.store');
    });
});