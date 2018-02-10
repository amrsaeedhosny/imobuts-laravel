<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Dirape\Token\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @resource User API Controller
 *
 */
class APIUserController extends Controller
{
	/**
	 * @param  string  $email  The email of the user
	 * @param  string  $username  The username of the user
	 * @param  string  $password  The password of the user
	 * @return array
	 */
    public function signUp(Request $request){
    	$email = $request->email ;
    	$password = $request->password;
    	$username = $request->username;
	    $validator = Validator::make($request->toArray(),[
		    'username' => 'required|unique:customers',
		    'password' => 'required',
		    'email' => 'required|unique:customers'
	    ]);
	    $response = array('response' => [], 'success'=>true,'token'=>'');
	    if($validator->fails()){
		    $response['response'] = $validator->messages();
		    $response['success'] = false;
	    } else{
	    	$token = new Token();
		    $customer = new Customer();
		    $customer->username = $username;
		    $customer->password = bcrypt($password);
		    $customer->email = $email;
		    $customer->token = $token->Unique('customers', 'token', 10 );
		    $response['token'] = $customer->token;
		    $customer->save();
	    }
	    return response()->json($response);
    }

	/**
	 * @param  string  $username  The username of the user
	 * @param  string  $password  The password of the user
	 * @return array
	 */
	public function signIn(Request $request){
		$username = $request->username;
		$password = $request->password;
		$validator = Validator::make($request->toArray(),[
			'username' => 'required|exists:customers',
			'password' => 'required',
		]);
		$response = array('response' => [], 'success'=>true,'token'=>'');
		if($validator->fails()){
			$response['response'] = $validator->messages();
			$response['success'] = false;
			return response()->json($response);
		}
		$customer = Customer::where(['username'=>$username])->first();
		if (!Hash::check($password, $customer->password)){
			$response['response']['password'] = "Password don't match";
			$response['success'] = false;
		}
		else {
			$response['token'] = Customer::where('username',$username)->first()->token;
		}
		return response()->json($response);
	}

	public function updateProfile(Request $request){

	}

	public function getProfile(Request $request){

	}

}
