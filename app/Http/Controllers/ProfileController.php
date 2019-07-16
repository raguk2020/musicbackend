<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
	public function updateProfile(ProfileRequest $req)
	{
		try {
			return $input = $req->all();
			return $this->successResponse('Journal Index added Successfully');			
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
