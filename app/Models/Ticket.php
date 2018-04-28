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
 * @property float $value
 * @property int $passengerID
 * @property \Carbon\Carbon $date
 * 
 * @property \App\Models\Passenger $passenger
 * @property \Illuminate\Database\Eloquent\Collection $payments
 *
 * @package App\Models
 */
class Ticket extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'price' => 'float',
		'passengerID' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'price',
		'passengerID',
		'date'
	];

	public function passenger()
	{
		return $this->belongsTo(\App\Models\Passenger::class, 'passengerID');
	}

	public function payments()
	{
		return $this->hasMany(\App\Models\Payment::class, 'ticketID');
	}
}
