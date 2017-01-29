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
  Route::resource('cottages', 'CottagesController');
  //Route::resource('promotions', 'PromotionsController');
  Route::resource('users', 'UsersController');
});
