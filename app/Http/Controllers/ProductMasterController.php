<?php namespace App\Http\Controllers;


use App\GroupMaster;
use App\ProductMaster;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductMasterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = ProductMaster::all();
		return view('ProductMaster.index')->withitems($items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$groups = GroupMaster::select('group_name as label')->get()->toJson();
		return view('ProductMaster.create', compact('groups'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'product_name' => 'required',
			'kg' => 'required',
			'selling_price' => 'required'
		]);

		$input = $request->all();

		ProductMaster::create($input);

		Session::flash('flash_message', 'Product Master successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('ProductMaster.create');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$items = ProductMaster::findOrFail($id);
		return view('ProductMaster.edit', compact('items'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$items = ProductMaster::findOrFail($id);

		$this->validate($request, [
			'product_name' => 'required',
			'kg' => 'required',
			'selling_price' => 'required'
		]);

		$input = $request->all();

		$items->fill($input)->save();

		Session::flash('flash_message', 'Product Master successfully Updated!');

		return redirect()->route('ProductMaster.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = ProductMaster::findOrFail($id);

		$item->delete();

		Session::flash('flash_message', 'Product Master successfully deleted!');

		return redirect()->route('ProductMaster.index');
	}

}
