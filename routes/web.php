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
use App\Mail\AlertNewRental;
use App\Mail\AlertUpdatedRental;
use App\BankingAccount;
use App\Rental;
use App\User;

Route::group(['middleware' => 'web'], function () {
    /**************************************
     * Base route app
     **************************************/
    Route::get('/', 'FrontendController@showHome')->name('home');
    Route::post('user_contact', 'FrontendController@userContact')->name('home.front.userContact');
    Route::get('our_location', 'FrontendController@ourLocation')->name('home.front.ourLocation');
    Route::get('tourist_attractions', 'FrontendController@touristAttractions')->name('home.front.touristAttractions');
    Route::get('about_us', 'FrontendController@aboutUs')->name('home.front.aboutUs');
    Route::get('policies_of_privacy', 'FrontendController@policiesPrivacy')->name('home.front.policiesPrivacy');
    Route::get('bases_and_terms', 'FrontendController@basesTerms')->name('home.front.basesTerms');
    Route::get('terms_and_onditions', 'FrontendController@termsConditions')->name('home.front.termsConditions');
    Route::get('confirm_account', 'Auth\RegisterController@confirmAccount')->name('home.register.confirm');
    Route::get('new_email_confirmation', 'Auth\RegisterController@newEmailConfirmation')->name('home.register.newEmail');
    Route::post('send_new_email_confirmation', 'Auth\RegisterController@sendNewEmailConfirmation')->name('home.register.sendNewEmail');
    Route::get('cottages', 'CottagesController@index')->name('home.cottages.index');
    Route::get('cottages/{slug}', 'CottagesController@show')->name('home.cottages.show');
    Route::get('profile/{slug}', 'UsersController@show')->name('home.profile.show');
    Route::get('profile/{slug}/edit', 'UsersController@edit')->name('home.profile.edit');
    Route::put('profile/{slug}', 'UsersController@update')->name('home.profile.update');
    Route::delete('profile/{slug}', 'UsersController@destroy')->name('home.profile.destroy');
    Route::get('profile/{slug}/rentals', 'UsersController@profileRentals')->name('home.profile.rentals');
    Route::get('password/change', 'UsersController@passwordChange')->name('home.password.change');
    Route::post('password/change/reset', 'UsersController@passwordReset')->name('home.password.reset');
    Route::get('rentals', 'RentalsController@index')->name('home.rentals.index');
    Route::get('rentals/edit', 'RentalsController@edit')->name('home.rentals.edit');
    Route::get('liquidation', 'LiquidationController@liquidation')->name('home.liquidation.liquidation');
    Route::get('order', 'OrdersController@index')->name('home.order.index');
    Route::get('order/edit', 'OrdersController@edit')->name('home.order.edit');

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
    Route::post('cottages/bulk_actions', 'CottagesController@cottagesBulkActions')->name('cottage.cottagesBulkActions');
    Route::get('food', 'FoodsController@index')->name('comidas.index');
    Route::get('reports', 'ReportsController@index')->name('reports.index');
    Route::get('promotions', 'PromotionsController@index')->name('promotions.index');
});

/*Route::prefix('test')->group(function() {
    Route::get('mail-welcome', function() {
        return new ConfirmAccount(User::find(158));
    });
    Route::get('mail-success', function() {
        $rental = Rental::find(25);
        $cuenta = BankingAccount::where('nro_cta', 'like', '300709%')->where('active', true)->first();
        $rental->banking = $cuenta;
        return new RentalSuccess($rental);
    });
    Route::get('alert-success', function() {
        $rental = Rental::find(25);
        $cuenta = BankingAccount::where('nro_cta', 'like', '300709%')->where('active', true)->first();
        $rental->banking = $cuenta;
        return new AlertNewRental($rental);
    });
    Route::get('alert-update', function() {
        $rental = Rental::find(25);
        $cuenta = BankingAccount::where('nro_cta', 'like', '300709%')->where('active', true)->first();
        $rental->banking = $cuenta;
        return new AlertUpdatedRental($rental);
    });
    Route::get('new-code', function() {
        $rental = Rental::find(10);
        $code = 'ABC52DEF'. time();
        return new \App\Mail\NewRentalCode($rental, $code);
    });
});*/
