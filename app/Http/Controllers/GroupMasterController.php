<?php namespace App\Http\Controllers;


use App\GroupMaster;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GroupMasterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = GroupMaster::all();
		return view('GroupMaster.index')->withitems($items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('GroupMaster.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'group_name' => 'required',
			'tax_percentage' => 'required'
		]);

		$input = $request->all();

		GroupMaster::create($input);

		Session::flash('flash_message', 'GroupMaster successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('GroupMaster.create');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$items = GroupMaster::findOrFail($id);

		return view('GroupMaster.edit')->withitems($items);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$items = GroupMaster::findOrFail($id);

		$this->validate($request, [
			'group_name' => 'required',
			'tax_percentage' => 'required'
		]);

		$input = $request->all();

		$items->fill($input)->save();

		Session::flash('flash_message', 'GroupMaster successfully Updated!');

		return redirect()->route('GroupMaster.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = GroupMaster::findOrFail($id);

		$item->delete();

		Session::flash('flash_message', 'GroupMaster successfully deleted!');

		return redirect()->route('GroupMaster.index');
	}


}
