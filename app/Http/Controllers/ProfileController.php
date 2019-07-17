<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ProfileRequest;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
	public function updateProfile(ProfileRequest $req)
	{
		try {
			$input = $req->all();
			$user = User::find($input['user_id']);
			$user->name = $input['name'];
			$user->save();
			return $this->successResponse('Profile Updated Successfully');			
		} catch (Exception $e) {			
			return $this->failedResponse($e);
		}
	}


	public function failedResponse($error)
	{
		return response()->json([
			'error' => $error,
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
