<?php

namespace App\Http\Controllers;

use App\Admin\Passengers\Passenger;
use App\Admin\Tickets\Ticket;
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
		$passenger = Passenger::where( 'token', $request->input('token' ))->with('tickets')->first();   // id here means user id
		$response  = array( 'response' => new \stdClass(), 'success' => true );
		$response['response']->tickets = $passenger->tickets;
		return response()->json( $response );
	}

	/**
	 * @param  string $token The unique token of the user
	 * @param integer $id the id of the ticket
	 *
	 * @return array
	 */
	public function getTicketDetails( Request $request ) {
        $passenger = Passenger::where( 'token', $request->input('token' ))->with('tickets')->first();
		$ticket   = Ticket::find( $request->input( 'id' ) );                                // id here means ticket id
        
        $validator = Validator::make( $request->toArray(), [
			'id' => 'exists:tickets',
            'token' =>'exists:passengers',
		] );
        
		$response = array( 'response' => new \stdClass(), 'success' => true );
        
        
        if ( $validator->fails() ) {
			$errors = $validator->errors();

			if (!empty( $errors->first('id'))) {
				$response['response']->id = $errors->first( 'id' );
			}
            if (!empty( $errors->first('token'))) {
				$response['response']->token = $errors->first( 'token' );
			}
         $response['success'] = false;     
        }
       
        else if ( $ticket && $passenger ) {
        $ticket->viewed = 1;
        $ticket->update();
        $response['response'] = $ticket;
		 }
		return response()->json( $response );
	}
}
