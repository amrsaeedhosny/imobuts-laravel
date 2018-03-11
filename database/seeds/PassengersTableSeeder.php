<?php

use Illuminate\Database\Seeder;

class PassengersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//
		factory( \App\Models\Passenger::class, 50 )->create()->each( function ( $passenger ) {
			$passenger->tickets()->save( factory( \App\Models\Ticket::class )->make() );
		} );
	}
}
