<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;


class PassengerLoggedIn {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		$validator = Validator::make( $request->toArray(), [
			'token' => 'required|exists:passengers',
		] );
		if ( $validator->fails() ) {
			$response['response'] = $validator->messages();
			$response['success']  = false;

			return response()->json( $response );
		}

		return $next( $request );
	}
}
