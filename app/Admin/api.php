<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Passengers'],function (){
	Route::post('signUp','APIPassengerController@signUp');
	Route::post( 'signIn', 'APIPassengerController@signIn' );
	Route::get( 'resetPassword', 'APIPassengerController@resetPassword' );
	Route::group( [ 'middleware' => \App\Http\Middleware\PassengerLoggedIn::class ], function () {
		Route::post( 'updateProfile', 'APIPassengerController@updateProfile' );
		Route::get( 'getProfile', 'APIPassengerController@getProfile' );
	} );
});

Route::group( [ 'namespace' => 'Tickets', 'middleware' => \App\Http\Middleware\PassengerLoggedIn::class ], function () {
	Route::get( 'tickets', 'APITicketController@getTickets' );
	Route::get( 'ticketDetails', 'APITicketController@getTicketDetails' );
});


Route::group( [ 'namespace' => 'Payment', 'middleware' => \App\Http\Middleware\PassengerLoggedIn::class ], function () {
	Route::post( 'issueTicket', 'APIPaymentController@buyTicket' );
});

