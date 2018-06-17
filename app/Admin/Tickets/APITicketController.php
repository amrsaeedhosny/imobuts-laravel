<?php

namespace App\Admin\Tickets;

use App\Admin\Passengers\Passenger;
use App\Admin\Tickets\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * @resource Ticket API Controller
 *
 */
class APITicketController extends Controller {
	/**
	 * @param  string $token The unique token of the user
	 *
	 * @return array
	 */
	public function getTickets( Request $request ) {
		$passenger                     = Passenger::where( 'token', $request->input( 'token' ) )->with( 'tickets' )->first();   // id here means user id
		$response                      = array( 'response' => new \stdClass(), 'success' => true );
		$response['response']->tickets = $passenger->tickets;

		return response()->json( $response );
	}

	/**
	 * @param  string $token The unique token of the user
	 * @param  integer $id the id of the ticket
	 *
	 * @return object
	 */
	public function getTicketDetails( Request $request ) {
		$validator = Validator::make( $request->toArray(), [
			'id' => 'required|exists:tickets'
		] );

		$response = array( 'response' => new \stdClass(), 'success' => true );

		if ( $validator->fails() ) {
			$errors = $validator->errors();

			if ( ! empty( $errors->first( 'id' ) ) ) {
				$response['response']->id = $errors->first( 'id' );
			}
			$response['success'] = false;
		}
		else {
			$ticket = Ticket::find( $request->input( 'id' ) );                                // id here means ticket id
			$ticket->viewed = 1;
			$ticket->update();
			$response['response'] = $ticket;
		}
		return response()->json( $response );
	}
}
