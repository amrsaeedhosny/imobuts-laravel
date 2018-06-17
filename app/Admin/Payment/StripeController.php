<?php
namespace App\Http\Controllers;
use App\Admin\Passengers\Passenger;
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
			$passenger->balance += $request->input( 'amount' ) / 100.0;
			$passenger->update();
			return 'Charge successful, you get the course!';
		} catch ( \Exception $ex ) {
			return $ex->getMessage();
		}
	}
}
// https://stripe.com/docs/testing#cards
// 4242424242424242