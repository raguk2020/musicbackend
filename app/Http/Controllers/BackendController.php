<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\JournalYear;

class BackendController extends Controller
{
	public function addjurnalYear(Request $req)
	{
		try {
			$input = $req->all();
			$insert = new JournalYear();
			$insert->title = $input['title'];
			$insert->volumeNo = $input['volumeNo'];
			$insert->year = $input['year'];
			$insert->status = 'active';
			$insert->save();
			return Response::json(['status' => 'success', 'message' => 'Successfully added']);			
		} catch (Exception $e) {
			return Response::json(['status' => 'faild', 'message' => $e]);
		}
	}
    
}
