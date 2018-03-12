<?php

use Faker\Generator as Faker;

$factory->define( \App\Models\Ticket::class, function ( Faker $faker ) {
	return [
		//
		'value'       => $faker->randomFloat( 1, 1, 100 ),
		'passengerID' => function () {
			return factory( App\User::class )->create()->id;
		},
		'date'        => $faker->dateTime
	];
} );