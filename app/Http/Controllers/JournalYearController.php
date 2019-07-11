<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\JournalYearRequest;
use App\JournalYear;

class JournalYearController extends Controller
{
	public function addJournalYear(JournalYearRequest $req)
	{
		try {
			$input = $req->all();
			$insert = new JournalYear();
			$insert->title = $input['title'];
			$insert->volumeNo = $input['volumeNo'];
			$insert->year = $input['year'];
			$insert->status = 'active';
			$insert->save();
			return $this->successResponse('Journal Year added Successfully');			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}
	public function getJournalYear()
	{
		try {			
			$journalyear = JournalYear::where('status', '!=', 'deleted')->get();			
			return $this->successResponse1('Journal Year added Successfully', $journalyear);			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function editJournalYear(Request $req)
	{
		try {
			$input = $req->all();
			$editId = $input['id'];			
			$journalyear = JournalYear::find($editId);			
			return $this->successResponse1('Journal Year added Successfully', $journalyear);			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function updateJournalYear(JournalYearRequest $req)
	{
		try {
			$input = $req->all();
			$insert = JournalYear::find($input['id']);
			$insert->title = $input['title'];
			$insert->volumeNo = $input['volumeNo'];
			$insert->year = $input['year'];
			$insert->save();
			return $this->successResponse('Journal Year updated Successfully');			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function statusJournalYear(Request $req)
	{
		try {
			$input = $req->all();
			$editId = $input['params'];			
			$journalyear = JournalYear::find($editId['id']);
			$current = $journalyear->status == 'active' ? 'inactive' : 'active';
			$journalyear->status = $current;
			$journalyear->save();
			return $this->successResponse1('Journal Year status changed Successfully', $current);			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function deleteJournalYear(Request $req)
	{
		try {
			$input = $req->all();
			$deleteId = $input['params'];			
			$journalyear = JournalYear::where('id', $deleteId['id'])->first();			
			$journalyear->status = 'deleted';
			$journalyear->save();
			return $this->successResponse('Journal Year deleted Successfully');			
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

	public function successResponse1($message, $data)
	{
		return response()->json([
			'status' => 'success',
			'data' => $message,
			'info' => $data,
		], Response::HTTP_OK);
	}
    
}
