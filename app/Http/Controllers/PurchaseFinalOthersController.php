<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\PurchaseOthers;
use App\PurchaseFinalOthers;
use Illuminate\Http\Request;

class PurchaseFinalOthersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = PurchaseFinalOthers::all();
		return view('PurchaseFinalOthers.index')->withitems($items);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
				'grand_total' => 'required',
				'sale_date' => 'required'
		]);

		$input = $request->all();

		PurchaseFinalOthers::create($input);

		Session::flash('flash_message', 'Billing successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('PurchaseOthers.create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the nerd
		$finaldatas = PurchaseFinalOthers::find($id);

		//getting items belongs to this bill:
		$matchThese = ['purchase_number' => $finaldatas->purchase_number];

		$items = PurchaseOthers::Where($matchThese)->get();
		$sum = PurchaseOthers::Where($matchThese)->sum('total');

		return view('PurchaseFinalOthers.show', compact('items', 'sum', 'finaldatas'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = PurchaseFinalOthers::findOrFail($id);

		//get corresponding products:

		$purchase_number = $item->purchase_number;
		$matchThese = ['purchase_number' => $purchase_number];
		$products = PurchaseOthers::Where($matchThese)->get();

		$item->delete();

		foreach($products as $product){
			$id = $product->id;
			$deletethisproduct = PurchaseOthers::findOrFail($id);
			$deletethisproduct->delete();
		}

		Session::flash('flash_message', 'Purchase successfully deleted!');

		return redirect()->route('PurchaseFinalOthers.index');
	}

}
