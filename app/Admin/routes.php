<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

	$router->group(['namespace'=>'Index'],function (Router $router){
		$router->get('/', 'HomeController@index');
	});

	$router->resources([
		'passengers'         => 'Passengers\PassengerController',
		'tickets'         => 'Tickets\TicketController',
	] );

	$router->group( [ 'namespace'  => 'Payment',
	                  'middleware' => \App\Http\Middleware\PaymentMiddleware::class
	], function ( Router $router ) {
		$router->get( 'stripe', 'PaymentController@getView' );
		$router->post( 'stripe', 'PaymentController@charge' )->name( 'charge' );
	} );
});
