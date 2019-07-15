<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogueRequest;
use App\Catalogue;
use App\Imports\CatalogueImport;
use DB;
use Maatwebsite\Excel\Facades\Excel;


class CatalogueController extends Controller
{
    public function addcatalogue(CatalogueRequest $req)
	{
		try {
			$input = $req->all();
			$insert = new Catalogue();
			$insert->author = $input['author'];
			$insert->title = $input['title'];
			$insert->subtitle = $input['subtitle'];
			$insert->statementOfResponsibility = $input['statementOfResponsibility'];
			$insert->edition = $input['edition'];
			$insert->placeOfPublish = $input['placeOfPublish'];
			$insert->publisher = $input['publisher'];
			$insert->yearOfPublish = $input['yearOfPublish'];
			$insert->pages = $input['pages'];
			$insert->notes = $input['notes'];
			$insert->donation = $input['donation'];
			$insert->subjectPersonal = $input['subjectPersonal'];
			$insert->subjectTopicsI = $input['subjectTopicsI'];
			$insert->subjectTopicsII = $input['subjectTopicsII'];
			$insert->subjectPlaceI = $input['subjectPlaceI'];
			$insert->subjectPlaceII = $input['subjectPlaceII'];
			$insert->editor = $input['editor'];
			$insert->shelfMark = $input['shelfMark'];			
			$insert->bookStatus = 'available';
			$insert->status = 'active';			
			$insert->save();
			return $this->successResponse('Catalogue added Successfully');			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function getcatalogue()
	{
		try {			
			$catalogue = Catalogue::where('status', '!=', 'deleted')->get();			
			return $this->successResponse1('Success', $catalogue);			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function editcatalogue(Request $req)
	{
		try {
			$input = $req->all();
			$editId = $input['id'];			
			$catalogue = Catalogue::find($editId);			
			return $this->successResponse1('Success', $catalogue);			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function updatecatalogue(CatalogueRequest $req)
	{
		try {
			$input = $req->all();
			$insert = Catalogue::find($input['id']);
			$insert->author = $input['author'];
			$insert->title = $input['title'];
			$insert->subtitle = $input['subtitle'];
			$insert->statementOfResponsibility = $input['statementOfResponsibility'];
			$insert->edition = $input['edition'];
			$insert->placeOfPublish = $input['placeOfPublish'];
			$insert->publisher = $input['publisher'];
			$insert->yearOfPublish = $input['yearOfPublish'];
			$insert->pages = $input['pages'];
			$insert->notes = $input['notes'];
			$insert->donation = $input['donation'];
			$insert->subjectPersonal = $input['subjectPersonal'];
			$insert->subjectTopicsI = $input['subjectTopicsI'];
			$insert->subjectTopicsII = $input['subjectTopicsII'];
			$insert->subjectPlaceI = $input['subjectPlaceI'];
			$insert->subjectPlaceII = $input['subjectPlaceII'];
			$insert->editor = $input['editor'];
			$insert->shelfMark = $input['shelfMark'];			
			$insert->bookStatus = 'available';
			$insert->save();
			return $this->successResponse('Catalogue updated Successfully');			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}


	public function statuscatalogue(Request $req)
	{
		try {
			$input = $req->all();
			$editId = $input['params'];			
			$catalogue = Catalogue::find($editId['id']);
			$current = $catalogue->status == 'active' ? 'inactive' : 'active';
			$catalogue->status = $current;
			$catalogue->save();
			return $this->successResponse1('Catalogue status changed Successfully', $current);			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function deletecatalogue(Request $req)
	{
		try {
			$input = $req->all();
			$deleteId = $input['params'];			
			$catalogue = Catalogue::where('id', $deleteId['id'])->first();			
			$catalogue->status = 'deleted';
			$catalogue->save();
			return $this->successResponse('Catalogue deleted Successfully');			
		} catch (Exception $e) {
			return $this->failedResponse($e);
		}
	}

	public function importData(Request $request)
	{
		try {

			$request->validate([
				'file0' => 'required'
			]);

			$path = $request->file('file0')->getRealPath();
			$data = Excel::import(new CatalogueImport,$request->file('file0'));		

			$journalyear = Catalogue::where('status', '!=', 'deleted')->get();
			return $this->successResponse1('Success', $journalyear);			

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
