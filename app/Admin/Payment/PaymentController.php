<?php

namespace App\Admin\Payment;

use App\Admin\Passengers\Passenger;
use App\Admin\Tickets\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class APIPaymentController extends Controller {

	/**
	 * @param  string $id The id of the user
	 * @param  float $value the ticket cost
	 * @param  float $balance the user current balance
	 *
	 * @return array
	 */
	public function cutTicket( Request $request ) {
		$price     = $request->input( 'price' );
		$passenger = Passenger::where( 'token', $request->input( 'token' ) )->first();
		$validator = Validator::make( $request->toArray(), [
			'token' => 'required|exists:passengers',
			'price' => 'required',
		] );

		$response = array( 'response' => new \stdClass(), 'success' => true );
		if ( $validator->fails() ) {
			$errors = $validator->errors();
			if ( ! empty( $errors->first( 'token' ) ) ) {
				$response['response']->token = $errors->first( 'token' );
			}
			if ( ! empty( $errors->first( 'price' ) ) ) {
				$response['response']->price = $errors->first( 'price' );
			}
			$response['success'] = false;

			return response()->json( $response );
		}

		if ( $passenger && ( $passenger->balance - $price >= 0 ) ) {      // in IoT machine checks if price is less than balance as well
			/*  generate ticket for that user  */
			$ticket              = new Ticket();
			$ticket->price       = $price;
			$ticket->date        = Carbon::now();
			$date                = Carbon::now();
			$ticket->passengerID = $passenger->id;
			//$ticket->code = bcrypt(($passenger->token).($ticket->date));
			for ( $i = 0; $i < 19; $i ++ ) {
				if ( $date[ $i ] == ' ' || $date[ $i ] == '-' || $date[ $i ] == ':' ) {
					$date[ $i ] = $passenger->token[ $j ];
					$j ++;
				}
			}
			$ticket->code = bcrypt( ( $date ) . ( $passenger->id ) );
			$ticket->save();

			/*  update passenger balance */
			$passenger->balance = $passenger->balance - $price;
			$passenger->update();
			$response['response']->newTicket = "new ticket has been issued";
		} else {
			$response['success'] = false;
		}

		return response()->json( $response );
	}
}