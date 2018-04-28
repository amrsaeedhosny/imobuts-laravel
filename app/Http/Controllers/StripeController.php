<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Ticket;
use Dirape\Token\Token;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class StripeController extends Controller {
	//

	public function getView() {
		return view( 'stripe' );
	}

	public function charge( Request $request ) {
		try {
			Stripe::setApiKey( env( 'STRIPE_SECRET_KEY' ) );

			$customer = Customer::create( array(
				'email'  => $request->stripeEmail,
				'source' => $request->stripeToken
			) );

			$charge             = Charge::create( array(
				'customer' => $customer->id,
				'amount'   => $request->input( 'amount' ),
				'currency' => 'egp'
			) );
			$passenger          = Passenger::where( 'token', $request->input( 'token' ) )->first();
			$passenger->balance += $request->input( 'amount' );
			$passenger->update();
			$token               = new Token();
			$ticket              = new Ticket();
			$ticket->date        = time();
			$ticket->passengerID = $passenger->id;
			$ticket->price       = $request->input( 'amount' );
			$ticket->code        = $token->Unique( 'tickets', 'code', 10 );
			$ticket->save();

			return 'Charge successful, you get the course!';
		} catch ( \Exception $ex ) {
			return $ex->getMessage();
		}
	}
}
// https://stripe.com/docs/testing#cards
// 4242424242424242