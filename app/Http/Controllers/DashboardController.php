<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Catalogue;
use App\JournalIndex;
use App\JournalYear;


class DashboardController extends Controller
{
    
  public function getdasboardcount()
	{
		try {			
			
			$info['catalogue'] = Catalogue::where('status', '!=', 'deleted')->count();			
			$info['jurnalindex'] = JournalIndex::where('status', '!=', 'deleted')->count();			
			$info['jurnalyear'] = JournalYear::where('status', '!=', 'deleted')->count();		

			return $this->successResponse('Success', $info);			
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
	

	public function successResponse($message, $data)
	{
		return response()->json([
			'status' => 'success',
			'data' => $message,
			'info' => $data,
		], Response::HTTP_OK);
	}


}
