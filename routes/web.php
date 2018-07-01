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
<<<<<<< Updated upstream

Route::get( '/', function () {
	return redirect( '/admin' );
} );

=======
Route::get( '/', function () {
	return redirect( '/admin' );
} );
>>>>>>> Stashed changes
Route::get('docs', function(){
	return View::make('docs.api.index');
});
<<<<<<< HEAD
Route::group(['middleware'=>\App\Http\Middleware\PaymentMiddleware::class],function (){
	Route::get( 'stripe', 'StripeController@getView' );
	Route::post( 'stripe', 'StripeController@charge' )->name( 'charge' );
<<<<<<< Updated upstream
});
=======
>>>>>>> 6ad19c51995a0da56ab1a4e2a7c7c5e6a1859857

=======
});
>>>>>>> Stashed changes
