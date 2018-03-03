
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APITicketController extends Controller
{
	public function getTickets(Request $request){
     $tickets = Tickets::where('PassengerID' ,'=', $request->id)->get();   // id here means user id  
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

	public function getTicketDetails(Request $request){
      $ticket = Ticket::find($request->id)                                // id here means ticket id
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
