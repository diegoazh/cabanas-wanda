<?php
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

/*---------------------------------------------------------------------------
 * FRONTEND ROUTES
 *---------------------------------------------------------------------------
 *
 * Aquí pondremos las rutas del frontend divididas por secciones.
 *
 */

use App\Mail\ConfirmAccount;
use App\Mail\RentalSuccess;
use App\Rental;

Route::group(['middleware' => 'web'], function () {
    /**************************************
     * Base route app
     **************************************/
    Route::get('/', 'FrontendController@showHome')->name('home');
    Route::get('confirm_account', 'Auth\RegisterController@confirmAccount')->name('home.register.confirm');
    Route::get('new_email_confirmation', 'Auth\RegisterController@newEmailConfirmation')->name('home.register.newEmail');
    Route::post('send_new_email_confirmation', 'Auth\RegisterController@sendNewEmailConfirmation')->name('home.register.sendNewEmail');
    Route::get('cottages', 'CottagesController@index')->name('home.cottages.index');
    Route::get('cottages/{slug}', 'CottagesController@show')->name('home.cottages.show');
    Route::get('profile/{slug}', 'UsersController@show')->name('home.profile.show');
    Route::get('profile/{slug}/edit', 'UsersController@edit')->name('home.profile.edit');
    Route::put('profile/{slug}', 'UsersController@update')->name('home.profile.update');
    Route::delete('profile/{slug}', 'UsersController@destroy')->name('home.profile.destroy');
    Route::get('rentals', 'RentalsController@index')->name('home.rentals.index');
    Route::get('rentals/edit', 'RentalsController@edit')->name('home.rentals.edit');
    Route::get('liquidation', 'LiquidationController@liquidation')->name('home.liquidation.liquidation');
    Route::get('order', 'OrdersController@index')->name('home.order.index');

    /**************************************
     * Auth Routes
     **************************************/
    Auth::routes();
});

/*---------------------------------------------------------------------------
 * BACKEND ROUTES
 *---------------------------------------------------------------------------
 *
 * Aquí pondremos las rutas del backend divididas por secciones.
 *
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Administration', 'middleware' => ['auth', 'isAdminOrEmployed']], function () {
    Route::get('/', 'BackendController@showPanel')->name('admin.panel');
    Route::resource('frontend', 'FrontendController');
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::put('users/{user}', 'UsersController@update')->name('users.update')->middleware('isEmployed');
    Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy')->middleware('isEmployed');
    Route::resource('cottages', 'CottagesController');
    Route::get('food', 'FoodsController@index')->name('comidas.index');
    Route::get('reports', 'ReportsController@index')->name('reports.index');
    //Route::resource('promotions', 'PromotionsController');
});

Route::prefix('test')->group(function() {
    Route::get('mail-welcome', function() {
        return new ConfirmAccount(User::find(158));
    });
    Route::get('mail-success', function() {
        return new RentalSuccess(Rental::find(25));
    });
});
