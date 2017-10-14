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
        Route::post('rentals', 'RentalsController@rentals')->name('api.rentals.rentals');
    });
});

Route::prefix('food')->middleware(['jwt.auth', 'jwt.refresh'])->group(function () {
    Route::post('rentals', 'Administration\ComidasController@rentals')->name('api.food.rentals');
});