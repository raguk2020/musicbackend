<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class UpdatePasswordController extends Controller
{
	public function ChangePassword(UpdatePasswordRequest $request)
	{
		try {
			$input = $request->all();
			$user = User::find($input['user_id']);
			$user->password = $input['password'];
			$user->save();		

			return $this->successResponse('Password changed Successful');			
		} catch (Exception $e) {			
			return $this->failedResponse($e);
		}
	}


	public function failedResponse($error)
	{
		return response()->json([
			'errors' => $error,
		], Response::HTTP_NOT_FOUND);		
	}

	public function successResponse($message)
	{
		return response()->json([
			'status' => 'success',
			'data' => $message,
		], Response::HTTP_OK);
	}
}
