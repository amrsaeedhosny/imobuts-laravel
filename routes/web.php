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
	Route::get('signIn','APIUserController@signIn');
    Route::get('resetPassword,APIUserController@resetPassword');

    Route::post('updateProfile','APIUserController@updateProfile');
	Route::get('getProfile','APIUserController@getProfile');
    
    Route::get('tickets','APITicketController@getTickets');
    Route::get('ticketInfo' ,'APITicketController@getTicketDetails'); 
    Route::post('issueTicket' ,'APIPaymentController@cutTicket');

});

Route::get('docs', function(){
	return View::make('docs.api.index');
});