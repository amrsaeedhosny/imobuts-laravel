<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Feb 2018 18:03:05 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Payment
 * 
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property int $customerID
 * @property int $ticketID
 * 
 * @property \App\Models\Customer $customer
 * @property \App\Models\Ticket $ticket
 *
 * @package App\Models
 */
class Payment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'customerID' => 'int',
		'ticketID' => 'int'
	];

	protected $fillable = [
		'customerID',
		'ticketID'
	];

	public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class, 'customerID');
	}

	public function ticket()
	{
		return $this->belongsTo(\App\Models\Ticket::class, 'ticketID');
	}
}
