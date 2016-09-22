<?php namespace App\Http\Controllers;

use App\GroupMaster;
use App\ProductMasterOthers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Illuminate\Http\Request;

class ProductMasterOthersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = ProductMasterOthers::all();
		return view('ProductMasterOthers.index')->withitems($items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$groups = GroupMaster::select('group_name as label')->get()->toJson();
		return view('ProductMasterOthers.create', compact('groups'));
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

		ProductMasterOthers::create($input);

		Session::flash('flash_message', 'Product Master Others successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('ProductMasterOthers.create');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$items = ProductMasterOthers::findOrFail($id);
		return view('ProductMasterOthers.edit', compact('items'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$items = ProductMasterOthers::findOrFail($id);

		$this->validate($request, [
				'product_name' => 'required',
				'kg' => 'required',
				'selling_price' => 'required'
		]);

		$input = $request->all();

		$items->fill($input)->save();

		Session::flash('flash_message', 'Product Master Others successfully Updated!');

		return redirect()->route('ProductMasterOthers.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = ProductMasterOthers::findOrFail($id);

		$item->delete();

		Session::flash('flash_message', 'Product Master successfully deleted!');

		return redirect()->route('ProductMasterOthers.index');
	}

}
