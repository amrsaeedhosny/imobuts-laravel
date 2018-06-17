<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Feb 2018 18:03:05 +0000.
 */

namespace App\Admin\Payment;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Payment
 * 
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property int $passengerID
 * @property int $ticketID
 * 
 * @property \App\Admin\Passengers\Passenger $passenger
 * @property \App\Admin\Tickets\Ticket $ticket
 *
 * @package App\Models
 */
class Payment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'passengerID' => 'int',
		'ticketID' => 'int'
	];

	protected $fillable = [
		'passengerID',
		'ticketID'
	];

	public function passenger()
	{
		return $this->belongsTo(\App\Admin\Passengers\Passenger::class, 'passengerID');
	}

	public function ticket()
	{
		return $this->belongsTo(\App\Admin\Tickets\Ticket::class, 'ticketID');
	}
}
