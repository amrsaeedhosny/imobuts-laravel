<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class PaymentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	    $validator = Validator::make( $request->toArray(), [
		    'token' => 'required|exists:passengers',
		    'amount' => 'required',
	    ] );
	    $response  = array( 'response' => new \stdClass(), 'success' => true);

	    if ( $validator->fails() ) {
		    $errors              = $validator->errors();
		    $response['success'] = false;

		    if ( ! empty( $errors->first( 'token' ) ) ) {
			    $response['response']->token = $errors->first( 'token' );
		    }
		    if ( ! empty( $errors->first( 'amount' ) ) ) {
			    $response['response']->email = $errors->first( 'amount' );
		    }
		    return response()->json($response);
	    }

        return $next($request);
    }
}
