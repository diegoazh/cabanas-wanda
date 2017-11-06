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

Route::prefix('auth')->group(function() {
    Route::post('auth', 'Auth\AuthenticateController@authenticate')->name('api.auth.auth');
});

Route::prefix('cottages')->group(function() {
    Route::get('enabled', 'CottagesController@cottagesEnabled')->name('api.cottages.enabled');
});

Route::prefix('passengers')->group(function() {
    Route::post('store', 'PassengersController@store')->name('api.passengers.store');
});

// No olvidar hacer pasar las peticiones por el middleware jwt.auth
Route::prefix('rentals')->group(function() {
    Route::post('availables', 'RentalsController@cottagesAvailables')->name('api.rentals.availabels');
    Route::post('find', 'RentalsController@find')->name('api.rentals.find');
    Route::post('store', 'RentalsController@store')->name('api.rentals.store');
});

Route::prefix('food')->group(function() {
    Route::get('all', 'Administration\FoodsController@all')->name('api.food.all');

    Route::middleware(['jwt.auth', 'jwt.refresh'])->group(function () {
        Route::post('store', 'Administration\FoodsController@store')->name('api.food.store');
        Route::put('update/{id}', 'Administration\FoodsController@update')->name('api.food.update');
        Route::delete('destroy/{id}', 'Administration\FoodsController@destroy')->name('api.food.destroy');
    });
});

Route::prefix('orders')->group(function() {
    Route::middleware(['jwt.auth', 'jwt.refresh'])->group(function () {
        Route::post('store', 'OrdersController@store')->name('api.orders.store');
    });
});

Route::prefix('liquidation')->group(function() {
    Route::post('final', 'LiquidationController@finalLiquidation')->name('api.liquidation.final');
});

Route::prefix('reports')->group(function() {
    Route::get('rentals', 'Administration\ReportsController@rentalsForMonth')->name('api.reports.rentals');
});