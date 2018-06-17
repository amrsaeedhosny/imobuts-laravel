<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Passengers'],function (){
	Route::post('signUp','APIPassengerController@signUp');
	Route::post( 'signIn', 'APIPassengerController@signIn' );
	Route::get( 'resetPassword', 'APIPassengerController@resetPassword' );
	Route::group( [ 'middleware' => \App\Http\Middleware\PassengerLoggedIn::class ], function () {
		Route::post( 'updateProfile', 'APIPassengerController@updateProfile' );
		Route::get( 'getProfile', 'APIPassengerController@getProfile' );

		Route::get( 'tickets', 'APITicketController@getTickets' );
		Route::get( 'ticketDetails', 'APITicketController@getTicketDetails' );

		Route::post('issueTicket' ,'APIPaymentController@cutTicket');
	} );
});

Route::group(['namespace'=>'Tickets'],function (){
	Route::group( [ 'middleware' => \App\Http\Middleware\PassengerLoggedIn::class ], function () {

		Route::get( 'tickets', 'APITicketController@getTickets' );
		Route::get( 'ticketDetails', 'APITicketController@getTicketDetails' );

	} );
});


Route::group(['namespace'=>'Payment'],function (){
	Route::group( [ 'middleware' => \App\Http\Middleware\PassengerLoggedIn::class ], function () {


		Route::post('issueTicket' ,'APIPaymentController@cutTicket');
	} );
});

