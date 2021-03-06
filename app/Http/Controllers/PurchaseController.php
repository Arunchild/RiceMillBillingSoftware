<?php namespace App\Http\Controllers;

use App\ProductMaster;
use App\Purchase;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PurchaseFinal;
use DB;
use Illuminate\Http\Request;
use Session;

class PurchaseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Purchase::all();
		return view('Purchase.index')->withitems($items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$rows = DB::select('SELECT max(purchase_number) as purchase_number FROM purchase_finals WHERE 1');

		foreach($rows as $row){

			$purchase_number = $row->purchase_number;
		}

		$purchase_number = $purchase_number + 1;

		//getting items belongs to this bill:
		$matchThese = [ 'purchase_number' => $purchase_number ];

		$items = Purchase::Where($matchThese)->get();

		$sum = Purchase::Where($matchThese)->sum('total');

		$products = ProductMaster::select('product_name as label', 'id as product_code', 'product_name as product_name', 'kg as kg', 'selling_price as selling_price' )->get()->toJson();
		return view('Purchase.create', compact('products', 'purchase_number', 'items', 'sum'));
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


		Purchase::create($input);

		Session::flash('flash_message', 'Billing successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('Purchase.create');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$items = Purchase::findOrFail($id);
		return view('Purchase.edit', compact('items'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$items = Purchase::findOrFail($id);

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

		$grandtotal = Purchase::Where($matchThese)->sum('total');

		$itemsfinalid = PurchaseFinal::Where($matchThese)->select('id')->first();
        $itemsfinal = PurchaseFinal::findOrFail($itemsfinalid->id);

        $itemsfinal['grand_total'] = $grandtotal;
        $itemsfinal->save();


		Session::flash('flash_message', 'Purchase successfully Updated!');

		return redirect()->route('PurchaseFinal.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = Purchase::findOrFail($id);

		$purchase_number = $item->purchase_number;
		$matchThese = ['purchase_number' => $purchase_number];

		$item->delete();

        $grandtotal = Purchase::Where($matchThese)->sum('total');

        $itemsfinalid = PurchaseFinal::Where($matchThese)->select('id')->first();

		if(!empty($itemsfinalid)){
			$itemsfinal = PurchaseFinal::findOrFail($itemsfinalid->id);
			$itemsfinal['grand_total'] = $grandtotal;
			$itemsfinal->save();
		}


		Session::flash('flash_message', 'Billing successfully deleted!');

		return redirect()->route('Purchase.create');
	}

}
