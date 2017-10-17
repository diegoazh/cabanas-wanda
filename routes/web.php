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
Route::group(['middleware' => 'web'], function () {
    /**************************************
     * Base route app
     **************************************/
    Route::get('/', 'FrontendController@showHome')->name('home');
    Route::get('cottages', 'CottagesController@index')->name('home.cottages.index');
    Route::get('cottages/{slug}', 'CottagesController@show')->name('home.cottages.show');
    Route::get('profile/{slug}', 'UsersController@show')->name('home.profile.show');
    Route::get('profile/{slug}/edit', 'UsersController@edit')->name('home.profile.edit');
    Route::put('profile/{slug}', 'UsersController@update')->name('home.profile.update');
    Route::delete('profile/{slug}', 'UsersController@destroy')->name('home.profile.destroy');
    Route::get('rentals', 'RentalsController@index')->name('home.rentals.index');
    Route::get('order', 'PedidosController@index')->name('home.order.index');

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
    Route::put('users/{user}', 'UsersController@update')->name('users.update');
    Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy');
    Route::resource('cottages', 'CottagesController');
    Route::get('food', 'ComidasController@index')->name('comidas.index');
    //Route::resource('promotions', 'PromotionsController');
});
