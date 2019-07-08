<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ResetPasswordController extends Controller
{
	public function sendEmail(Request $request)
	{
		if (!$this->validateEmail($request->email)) {
			return $this->failedResponse();			
		}
		$this->send($request->email);
		return $this->successResponse();			
	}

	public function send($email)
	{
		$token = $this->createToken($email);
		Mail::to($email)->send(new ResetPasswordMail($token));
	}

	public function createToken($email)
	{
		$oldToken = DB::table('password_resets')->where('email', $email)->first();
		if ($oldToken) {
			return $oldToken;
		}
		$token = str_random(60);
		$this->saveToken($token, $email);
		return $token;
	}

	public function saveToken($token, $email)
	{
		DB::table('password_resets')->insert([
			'email' => $email,
			'token' => $token,
			'created_at' => Carbon::now()
		]);		
	}

	public function validateEmail($email)
	{
		if($email){
    		return User::where('email',$email)->first();
    	}
	}

	public function failedResponse()
	{
		return response()->json([
			'error' => 'Email Not Found In Database',
		], Response::HTTP_NOT_FOUND);		
	}

	public function successResponse()
	{
		return response()->json([
			'data' => 'Reset Mail Had Been Sent Successfully, Check your email',
		], Response::HTTP_OK);
	}
    

}
