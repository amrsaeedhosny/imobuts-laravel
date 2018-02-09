<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Feb 2018 18:03:05 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Customer
 * 
 * @property int $id
 * @property string $fullname
 * @property string $username
 * @property string $email
 * @property string $address
 * @property float $balance
 * @property string $password
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $payments
 * @property \Illuminate\Database\Eloquent\Collection $tickets
 *
 * @package App\Models
 */
class Customer extends Eloquent
{
	protected $casts = [
		'balance' => 'float'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'fullname',
		'username',
		'email',
		'address',
		'balance',
		'password'
	];

	public function payments()
	{
		return $this->hasMany(\App\Models\Payment::class, 'customerID');
	}

	public function tickets()
	{
		return $this->hasMany(\App\Models\Ticket::class, 'customerID');
	}
}
