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

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/'],function() {
	Auth::routes();
	Route::get( '/', function () {
		return view( 'welcome' );
	} );
});

Route::group(['prefix'=>'/api'],function(){
	Route::post('signUp','APIUserController@signUp');
	Route::post( 'signIn', 'APIUserController@signIn' );
	Route::get( 'resetPassword', 'APIUserController@resetPassword' );
	Route::group( [ 'middleware' => \App\Http\Middleware\PassengerLoggedIn::class ], function () {
		Route::post( 'updateProfile', 'APIUserController@updateProfile' );
		Route::get( 'getProfile', 'APIUserController@getProfile' );

		Route::get( 'tickets', 'APITicketController@getTickets' );
		Route::get( 'ticketDetails', 'APITicketController@getTicketDetails' );
        
        Route::post('issueTicket' ,'APIPaymentController@cutTicket');
	} );


});

Route::get('docs', function(){
	return View::make('docs.api.index');
});
Route::group(['middleware'=>\App\Http\Middleware\PaymentMiddleware::class],function (){
	Route::get( 'stripe', 'StripeController@getView' );
	Route::post( 'stripe', 'StripeController@charge' )->name( 'charge' );
});

