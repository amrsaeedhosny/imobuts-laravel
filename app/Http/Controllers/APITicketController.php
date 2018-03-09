<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

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
		$tickets  = Ticket::where( 'token', $request->input( 'token' ) )->get();   // id here means user id
		$response = array( 'response' => [], 'success' => true );
		if ( $tickets ) {
			$response['response'] = $tickets;
		} else {
			$response['success'] = false;
		}

		return response()->json( $response );

	}

	/**
	 * @param  string $token The unique token of the user
	 * @param integer $id the id of the ticket
	 *
	 * @return array
	 */
	public function getTicketDetails( Request $request ) {
		$ticket   = Ticket::find( $request->input( 'id' ) );                                // id here means ticket id
		$response = array( 'response' => [], 'success' => true );
		if ( $ticket ) {
			$response['response'] = $ticket;
		} else {
			$response['success'] = false;
		}

		return response()->json( $response );
	}
}
