<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Dirape\Token\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @resource Passenger API Controller
 *
 */
class APIUserController extends Controller {
	/**
	 * @param  string $email The email of the user
	 * @param  string $username The username of the user
	 * @param  string $password The password of the user
	 *
	 * @return array
	 */
	public function signUp( Request $request ) {
		$email     = $request->input( 'email' );
		$password  = $request->input( 'password' );
		$username  = $request->input( 'username' );
		$validator = Validator::make( $request->toArray(), [
			'username' => 'required|unique:passengers',
			'password' => 'required',
			'email'    => 'required|unique:passengers'
		] );
		$response  = array( 'response' => new \stdClass(), 'success' => true, 'token' => '' );
		if ( $validator->fails() ) {
			$errors = $validator->errors();
			$response['success']  = false;

			if (!empty($errors->first( 'username' ))) {
				$response['response']->username = $errors->first( 'username' );
			}
			if (!empty($errors->first( 'email' ))) {
				$response['response']->email = $errors->first( 'email' );
			}
			if (!empty( $errors->first( 'password' ))) {
				$response['response']->password = $errors->first( 'password' );
			}
		} else {
			$token = new Token();
			$passenger = new Passenger();
			$passenger->username = $username;
			$passenger->password = bcrypt( $password );
			$passenger->email = $email;
			$passenger->token = $token->Unique( 'passengers', 'token', 10 );
			$response['token'] = $passenger->token;
			$passenger->save();
		}

		return response()->json( $response );
	}

	/**
	 * @param  string $username The username of the user
	 * @param  string $password The password of the user
	 *
	 * @return array
	 */
	public function signIn( Request $request ) {
		$username  = $request->input( 'username' );
		$password  = $request->input( 'password' );
		$validator = Validator::make( $request->toArray(), [
			'username' => 'required|exists:passengers',
			'password' => 'required',
		] );
		$response  = array( 'response' => new \stdClass(), 'success' => true, 'token' => '' );
		if ( $validator->fails() ) {
//			$response['response'] = $validator->messages();
			$errors = $validator->errors();

			if (!empty( $errors->first('username'))) {
				$response['response']->username = $errors->first( 'username' );
			}
			if (!empty( $errors->first('password'))) {
				$response['response']->password = $errors->first( 'password' );
			}
			$response['success'] = false;
			return response()->json( $response );
		}
		$passenger = Passenger::where( [ 'username' => $username ] )->first();
		if (!Hash::check( $password, $passenger->password ) ) {
			$response['response'] = new \stdClass();
			$response['response']->password = "Password don't match";
			$response['success'] = false;
		} else {
			$response['token'] = Passenger::where( 'username', $username )->first()->token;
		}

		return response()->json( $response );
	}

	/**
	 * @param  string $email The email of the user
	 *
	 * @return array
	 */
	public function resetPassword( Request $request ) {
		$validator = Validator::make( $request->toArray(), [
			'email' => 'required|exists:passengers',
		] );
		if ( $validator->fails() ) {
			$errors = $validator->errors();
			$response['response'] = new \stdClass();
			if (!empty( $errors->first('email'))) {
				$response['response']->email = $errors->first( 'email' );
			}
			$response['success'] = false;
			return response()->json( $response );
		}
		$npass = str_random( 6 );
		Passenger::where( 'email', $request->input( 'email' ) )->update( [ 'password' => bcrypt( $npass ) ] );
		$data = "Your New Password is " . $npass;
		mail( $request->input('email'), 'Password Reset', $data );

		return response()->json( [ 'message' => 'Email sent to you with a new password', 'success' => 'true' ] );

	}

	/**
	 * @param  string $token The unique token of the user
	 * @param  string $email The email of the user
	 * @param  string $username The username of the user
	 * @param  string $password The password of the user
	 *
	 * @return array
	 */
	public function updateProfile( Request $request ) {
		$email     = $request->input( 'email' );
		$password  = $request->input( 'password' );
		$username  = $request->input( 'username' );
		$validator = Validator::make( $request->toArray(), [
			'username' => 'required|unique:passengers',
			'password' => 'required',
			'email'    => 'required|unique:passengers'
		] );
		$response  = array( 'response' => new \stdClass(), 'success' => true );
		if ( $validator->fails() ) {
			$errors = $validator->errors();

			if (!empty( $errors->first('email'))) {
				$response['response']->email = $errors->first('email');
			}
			if (!empty( $errors->first('password'))) {
				$response['response']->password = $errors->first('password');
			}
			if (!empty( $errors->first('username'))) {
				$response['response']->username = $errors->first('username');
			}
			$response['success']  = false;
		} else {
			$passenger = Passenger::where( 'token', $request->input('token') )->first();
			$passenger->username = $username;
			$passenger->email    = $email;
			$passenger->password = bcrypt( $password );
			$passenger->update();
		}
		return response()->json( $response );
	}

	/**
	 * @param  string $token The unique token of the user
	 *
	 * @return array
	 */
	public function getProfile( Request $request ) {
		$passenger = Passenger::where( 'token', $request->input( 'token' ) )->first();
		$response  = array( 'response' => new \stdClass(), 'success' => true );
		if ( $passenger ) {
			$response['response'] = $passenger;
		} else {
			$response['success'] = false;
		}

		return response()->json( $response );

	}
}
