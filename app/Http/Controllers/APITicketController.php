<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;


class APITicketController extends Controller
{
    /**
	 * @param  int  $id  The user id
	 * @return array
	 */
	public function getTickets(Request $request){
     $tickets = Ticket::where('PassengerID' ,'=', $request->id)->get();   // id here means user id  
     $response = array('response' => [], 'success'=>true);    
     if ($tickets)
      {
       $response['response'] = $tickets;
      }
     else
      {
       $response['success'] = false;
      }            
     return response()->json($response);    
         
	}

     /**
	 * @param  int  $id  Ticket id
	 * @return array
	 */
	public function getTicketDetails(Request $request){
      $ticket = Ticket::find($request->id);                                // id here means ticket id
      $response = array('response' => [], 'success'=>true);    
     if ($ticket)
      {
       $response['response'] = $ticket;
      }
     else
      {
       $response['success'] = false;
      }            
     return response()->json($response);
	}
}
