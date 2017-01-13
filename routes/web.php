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
Route::get('/', 'FrontendController@getHome')->name('home');

/**************************************
 * Auth Routes
 **************************************/
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logon', 'Auth\LoginController@logon')->name('logon');


/*---------------------------------------------------------------------------
 * BACKEND ROUTES
 *---------------------------------------------------------------------------
 *
 * Aquí pondremos las rutas del backend divididas por secciones.
 *
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Administration'], function () {

  Route::get('/panel', function () {
      return view('backend.panel');
  })->name('admin.panel');

  Route::resource('cottages', 'CottagesController');

  Route::resource('promotions', 'PromotionsController');
});
