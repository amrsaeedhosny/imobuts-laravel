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
			$errors                      = $validator->messages();
			$response['response']        = new \stdClass();
			$response['success']         = false;
			$response['response']->token = $errors->first( 'token' );

			return response()->json( $response );
		}

		return $next( $request );
	}
}
