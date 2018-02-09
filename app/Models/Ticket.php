<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Feb 2018 18:03:05 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Ticket
 * 
 * @property int $id
 * @property string $cMessage
 * @property float $value
 * @property int $customerID
 * @property \Carbon\Carbon $date
 * 
 * @property \App\Models\Customer $customer
 * @property \Illuminate\Database\Eloquent\Collection $payments
 *
 * @package App\Models
 */
class Ticket extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'value' => 'float',
		'customerID' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'cMessage',
		'value',
		'customerID',
		'date'
	];

	public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class, 'customerID');
	}

	public function payments()
	{
		return $this->hasMany(\App\Models\Payment::class, 'ticketID');
	}
}
