<?php namespace App\Http\Controllers;


use App\CompanyDetails;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyDetailsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = CompanyDetails::all();
		return view('company.index')->withitems($items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('company.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
				'tin' => 'required',
				'cst' => 'required',
				'companyname' 	=> 'required',
				'addressline1' 	=> 'required',
				'addressline2' 	=> 'required'
		]);

		$input = $request->all();

		CompanyDetails::create($input);

		Session::flash('flash_message', 'Company successfully added!');

		//TODO: redirect to company list page
		return redirect()->route('company.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$items = CompanyDetails::findOrFail($id);

		return view('company.edit')->withitems($items);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$items = CompanyDetails::findOrFail($id);

		$this->validate($request, [
				'tin' => 'required',
				'cst' => 'required',
				'companyname' 	=> 'required',
				'addressline1' 	=> 'required',
				'addressline2' 	=> 'required'
		]);

		$input = $request->all();

		$items->fill($input)->save();

		Session::flash('flash_message', 'Company successfully added!');

		return redirect()->route('company.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = CompanyDetails::findOrFail($id);

		$item->delete();

		Session::flash('flash_message', 'company successfully deleted!');

		return redirect()->route('company.index');
	}

}
