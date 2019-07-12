<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\JournalIndexRequest;
use App\JournalIndex;

class JournalIndexController extends Controller
{   

	public function addJournalIndex(JournalIndexRequest $req)
	{
		try {
			$input = $req->all();
			$insert = new JournalIndex();
			$insert->author = $input['author'];
			$insert->title = $input['title'];
			$insert->volumeNo = $input['volumeNo'];
			$insert->year = $input['year'];
			$insert->pages = $input['pages'];
			$insert->pdfLink = $input['filePath'];
			$insert->status = 'active';
			$insert->save();
			return $this->successResponse('Journal Index added Successfully');			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}
	public function getJournalIndex()
	{
		try {			
			$journalIndex = JournalIndex::where('status', '!=', 'deleted')->get();
			return $this->successResponse1('Success', $journalIndex);			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function editJournalIndex(Request $req)
	{
		try {
			$input = $req->all();
			$editId = $input['id'];			
			$journalIndex = JournalIndex::find($editId);			
			return $this->successResponse1('Success', $journalIndex);			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function updateJournalIndex(JournalIndexRequest $req)
	{
		try {
			$input = $req->all();
			$update = JournalIndex::find($input['id']);
			$update->author = $input['author'];
			$update->title = $input['title'];
			$update->volumeNo = $input['volumeNo'];
			$update->year = $input['year'];
			$update->pages = $input['pages'];
			$update->save();
			return $this->successResponse('Journal Index updated Successfully');			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function statusJournalIndex(Request $req)
	{
		try {
			$input = $req->all();
			$editId = $input['params'];			
			$journalIndex = JournalIndex::find($editId['id']);
			$current = $journalIndex->status == 'active' ? 'inactive' : 'active';
			$journalIndex->status = $current;
			$journalIndex->save();
			return $this->successResponse1('Journal Index status changed Successfully', $current);			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function deleteJournalIndex(Request $req)
	{
		try {
			$input = $req->all();
			$deleteId = $input['params'];			
			$journalIndex = JournalIndex::where('id', $deleteId['id'])->first();			
			$journalIndex->status = 'deleted';
			$journalIndex->save();
			return $this->successResponse('Journal Index deleted Successfully');			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function fileupload(Request $request) {
		try {
			
			$file = $request->file('file0');
			// $file->getRealPath();	
			// $file->getClientOriginalName();
			// $file->getClientOriginalExtension();
			// $file->getSize();
			// $file->getMimeType();
	     
			$destinationPath = 'uploads';
			$file->move($destinationPath,$file->getClientOriginalName());
			$filePath = $destinationPath.'/'.$file->getClientOriginalName();
			return $this->successResponse1('Success', $filePath);			
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
