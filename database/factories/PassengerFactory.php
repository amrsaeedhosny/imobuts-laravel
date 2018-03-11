<?php

use App\Models\Passenger;
use Faker\Generator as Faker;

$factory->define( Passenger::class, function ( Faker $faker ) {
	return [
		'fullname' => $faker->name,
		'balance'  => $faker->randomNumber(),
		'username' => $faker->userName,
		'email'    => $faker->email,
		'password' => $faker->password,
		'token'    => str_random( 6 )
	];
} );
