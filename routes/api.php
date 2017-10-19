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
    Route::post('find', 'RentalsController@find')->name('api.rentals.find');

    Route::middleware(['jwt.auth', 'jwt.refresh'])->group(function () {
        Route::post('store', 'RentalsController@store')->name('api.rentals.store');
    });
});

Route::prefix('food')->group(function () {
    Route::get('all', 'Administration\FoodsController@all')->name('api.food.all');

    Route::middleware(['jwt.auth', 'jwt.refresh'])->group(function () {
        Route::post('store', 'Administration\FoodsController@store')->name('api.food.store');
        Route::put('update/{id}', 'Administration\FoodsController@update')->name('api.food.update');
        Route::delete('destroy/{id}', 'Administration\FoodsController@destroy')->name('api.food.destroy');
    });
});