<?php namespace App\Http\Controllers;

use App\GroupMaster;
use App\ProductMasterKurunai;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductMasterKurunaiController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = ProductMasterKurunai::all();
		return view('ProductMasterKurunai.index')->withitems($items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$groups = GroupMaster::select('group_name as label')->get()->toJson();
		return view('ProductMasterKurunai.create', compact('groups'));
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

		ProductMasterKurunai::create($input);

		Session::flash('flash_message', 'Product Master successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('ProductMasterKurunai.create');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$items = ProductMasterKurunai::findOrFail($id);
		return view('ProductMasterKurunai.edit', compact('items'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$items = ProductMasterKurunai::findOrFail($id);

		$this->validate($request, [
				'product_name' => 'required',
				'kg' => 'required',
				'selling_price' => 'required'
		]);

		$input = $request->all();

		$items->fill($input)->save();

		Session::flash('flash_message', 'Product Master successfully Updated!');

		return redirect()->route('ProductMasterKurunai.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = ProductMasterKurunai::findOrFail($id);

		$item->delete();

		Session::flash('flash_message', 'Product Master successfully deleted!');

		return redirect()->route('ProductMasterKurunai.index');
	}

}
