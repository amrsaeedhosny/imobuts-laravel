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
     $passenger = Passenger::find($request->id);   
     if($request->balance - $request->value >= 0 && $passenger){    
       /*  generate ticket for that user  */   
       $ticket = new Ticket();
       $ticket->value = $request->value;
       $ticket->date = Carbon::now();
       $ticket->passengerID = $request->id;       
       $ticket->save();
    
       /*  update passenger balance */   
       $passenger->balance = $request->balance - $request->value;
       $passenger->update();
     }
   } 
}
