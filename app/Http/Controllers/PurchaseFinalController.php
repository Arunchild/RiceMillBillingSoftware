<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Purchase;
use App\PurchaseFinal;
use Illuminate\Http\Request;

class PurchaseFinalController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = PurchaseFinal::all();
		return view('PurchaseFinal.index')->withitems($items);
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

		PurchaseFinal::create($input);

		Session::flash('flash_message', 'Billing successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('Purchase.create');
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
		$finaldatas = PurchaseFinal::find($id);

		//getting items belongs to this bill:
		$matchThese = ['purchase_number' => $finaldatas->purchase_number];

		$items = Purchase::Where($matchThese)->get();
		$sum = Purchase::Where($matchThese)->sum('total');

		return view('PurchaseFinal.show', compact('items', 'sum', 'finaldatas'));
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
		$item = PurchaseFinal::findOrFail($id);

		//get corresponding products:

		$purchase_number = $item->purchase_number;
		$matchThese = ['purchase_number' => $purchase_number];
		$products = Purchase::Where($matchThese)->get();

		$item->delete();

		foreach($products as $product){
			$id = $product->id;
			$deletethisproduct = Purchase::findOrFail($id);
			$deletethisproduct->delete();
		}

		Session::flash('flash_message', 'Purchase successfully deleted!');

		return redirect()->route('PurchaseFinal.index');
	}

}
