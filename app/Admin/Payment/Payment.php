<?php

namespace App\Admin\Payment;

use App\Admin\Passengers\Passenger;
use App\Admin\Tickets\Ticket;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
	//
	public function ticket() {
		return $this->belongsTo( Ticket::class, 'ticketID' );
	}

	public function passenger() {
		return $this->belongsTo( Passenger::class, 'passengerID' );
	}
}
