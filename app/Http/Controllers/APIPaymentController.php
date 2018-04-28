<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Passenger;
use Illuminate\Http\Request;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

class APIPaymentController extends Controller
{
   
    /**
	 * @param  string  $id  The id of the user
     * @param  float $value the ticket cost
     * @param  float $balance the user current balance
	 * @return array
	 */ 
   public function cutTicket(Request $request){
     //$passenger = Passenger::find($request->id); 
     $price  = $request->input( 'price' );   
     $passenger = Passenger::where( 'token', $request->input('token') )->first();
    $response  = array( 'response' => '', 'success' => true );   
     if( $passenger && ($passenger->balance - $price >= 0)){    
       /*  generate ticket for that user  */   
       $ticket = new Ticket();
       $ticket->price = $price;
       $ticket->date = Carbon::now(); 
       $date = Carbon::now(); 
       $ticket->passengerID = $passenger->id;
       $ticket->code = ($passenger->token).($ticket->date);
         /*
       $code = substr($passenger->token,4);     
       $hiden_code = substr($passenger->token,4,9);
       $code_counter = 0;
       for($i = 0 ; $i < strlen($date) ; $i+=1){
           if($i == ':' || $i ==' ' || $i == '-'){
               str_replace($date[$i], hiden_code[$code_counter],$date);
               $code_counter++;
           }
       }
       $ticket->code = ($code).($date);  
       */
       $ticket->save();
    
       /*  update passenger balance */   
       $passenger->balance = $passenger->balance - $price;
       $passenger->update();
       $response['response'] = "new ticket has been issued";     
     }
    else{
        $response['success']  = false;
    }
    return response()->json( $response );   
   } 
}