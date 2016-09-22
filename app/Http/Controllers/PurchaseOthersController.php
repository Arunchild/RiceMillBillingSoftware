<?php namespace App\Http\Controllers;

use App\ProductMaster;
use App\ProductMasterOthers;
use App\PurchaseFinalOthers;
use App\PurchaseOthers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Session;

class PurchaseOthersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = PurchaseOthers::all();
		return view('PurchaseOthers.index')->withitems($items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$rows = DB::select('SELECT max(purchase_number) as purchase_number FROM purchase_final_others WHERE 1');

		foreach($rows as $row){

			$purchase_number = $row->purchase_number;
		}

		$purchase_number = $purchase_number + 1;

		//getting items belongs to this bill:
		$matchThese = [ 'purchase_number' => $purchase_number ];

		$items = PurchaseOthers::Where($matchThese)->get();

		$sum = PurchaseOthers::Where($matchThese)->sum('total');

		$products = ProductMasterOthers::select('product_name as label', 'id as product_code', 'product_name as product_name', 'kg as kg', 'selling_price as selling_price' )->get()->toJson();
		return view('PurchaseOthers.create', compact('products', 'purchase_number', 'items', 'sum'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
				'purchase_number' => 'required',
				'product_code' => 'required',
				'product_name' => 'required',
				'selling_price' => 'required',
				'sale_date' => 'required',
				'quantity' => 'required'
		]);


		$input = $request->all();

		$input['total'] = $input['selling_price'] * $input['quantity'];

		PurchaseOthers::create($input);

		Session::flash('flash_message', 'Billing successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('PurchaseOthers.create');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$items = PurchaseOthers::findOrFail($id);
		return view('PurchaseOthers.edit', compact('items'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$items = PurchaseOthers::findOrFail($id);

		$this->validate($request, [
				'purchase_number' => 'required',
				'product_code' => 'required',
				'product_name' => 'required',
				'selling_price' => 'required',
				'sale_date' => 'required',
				'quantity' => 'required'
		]);

		$input = $request->all();

		$purchase_number = $input['purchase_number'];

		$input['total'] = $input['selling_price'] * $input['quantity'];

		$items->fill($input)->save();

		$matchThese = [ 'purchase_number' => $purchase_number ];

		$grandtotal = PurchaseOthers::Where($matchThese)->sum('total');

		$itemsfinalid = PurchaseFinalOthers::Where($matchThese)->select('id')->first();
		$itemsfinal = PurchaseFinalOthers::findOrFail($itemsfinalid->id);

		$itemsfinal['grand_total'] = $grandtotal;
		$itemsfinal->save();

		Session::flash('flash_message', 'PurchaseOthers successfully Updated!');

		return redirect()->route('PurchaseFinalOthers.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = PurchaseOthers::findOrFail($id);

		$purchase_number = $item->purchase_number;
		$matchThese = ['purchase_number' => $purchase_number];

		$item->delete();

		$grandtotal = PurchaseOthers::Where($matchThese)->sum('total');

		$itemsfinalid = PurchaseFinalOthers::Where($matchThese)->select('id')->first();

		if(!empty($itemsfinalid)){
			$itemsfinal = PurchaseFinalOthers::findOrFail($itemsfinalid->id);
			$itemsfinal['grand_total'] = $grandtotal;
			$itemsfinal->save();
		}

		Session::flash('flash_message', 'Billing successfully deleted!');

		return redirect()->route('PurchaseOthers.create');
	}

}
