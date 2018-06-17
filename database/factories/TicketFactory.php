<?php

use Faker\Generator as Faker;

$factory->define( \App\Admin\Tickets\Ticket::class, function ( Faker $faker ) {
	return [
		//
		'price'       => $faker->randomFloat( 1, 1, 100 ),
		'passengerID' => function () {
			return factory( App\User::class )->create()->id;
		},
		'date'        => $faker->dateTime,
		'code'        => $faker->randomAscii,
		'viewed'      => $faker->boolean
 	];
} );
