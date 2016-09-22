<?php namespace App\Http\Controllers;

use App\Purchase;
use App\CompanyDetails;
use Carbon\Carbon;
use App\BillingFinal;
use App\ProductMaster;
use App\Billing;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use DB;

class BillingController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$company = CompanyDetails::all();
		$items = Billing::all();
		return view('Billing.index', compact('items', 'company'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		//getting bill number:
		$sale_date = date('Y-m-d');

		$rows = DB::select('SELECT grand_total, discount, max(bill_number) as bill_number FROM billing_finals WHERE 1');
		foreach($rows as $row){
			$bill_number = $row->bill_number;
		}
if($bill_number){
		$old_bill = BillingFinal::Where('bill_number', '=', $bill_number)->Where('deleted_at', '=', NULL)->select('grand_total', 'discount', 'net_amount')->first();
		
		if($old_bill){
			//echo 'yes';
		}else{
			$bill_number = $bill_number -1;
			$old_bill = BillingFinal::Where('bill_number', '=', $bill_number)->Where('deleted_at', '=', NULL)->select('grand_total', 'discount', 'net_amount')->first();
		}
		$grand_total = $old_bill->grand_total;
		$discount = $old_bill->discount;
		$old_net_amount = ($grand_total - $discount);
}else{
	$old_net_amount = 0;
}
		$bill_number = $bill_number + 1;

		//getting items belongs to this bill:
		$matchThese = ['bill_number' => $bill_number, 'sale_date' => $sale_date];

		$items = Billing::Where($matchThese)->get();

		$sum = Billing::Where($matchThese)->sum('total');

		$company = CompanyDetails::all();

		$codes = ProductMaster::select('id')->get();

		foreach($codes as $code){
			$product_code = $code['id'];
			$matchThese = [ 'product_code' => $product_code ];

			$purchaseditems = Purchase::Where($matchThese)->sum('quantity');
			$saleitems = Billing::Where($matchThese)->sum('quantity');
			$bal = $purchaseditems - $saleitems;

			$products_rows = ProductMaster::findOrFail($product_code);

			$products_rows->in_stock = $bal;

			$products_rows->save();
		}


		$products = ProductMaster::Where('in_stock', '>', 0)->select('product_name as label', 'id as product_code', 'product_name as product_name', 'kg as kg', 'selling_price as selling_price', 'in_stock as in_stock' )->get()->toJson();
		return view('Billing.create', compact('products', 'bill_number', 'items', 'sum', 'company', 'old_net_amount'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$this->validate($request, [
			'bill_number' => 'required',
			'product_code' => 'required',
			'product_name' => 'required',
			'selling_price' => 'required',
			'sale_date' => 'required',
			'quantity' => 'required'
		]);


		$input = $request->all();

		$input['total'] = $input['selling_price'] * $input['quantity'];

		$product_code = $input['product_code'];

		$matchThese = ['id' => $product_code];

		$kg = ProductMaster::Where($matchThese)->pluck('kg');

		$input['kg'] = $kg;

		Billing::create($input);

		Session::flash('flash_message', 'Billing successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('Billing.create');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$items = Billing::findOrFail($id);
		return view('Billing.edit', compact('items'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$items = Billing::findOrFail($id);

		$this->validate($request, [
			'bill_number' => 'required',
			'product_code' => 'required',
			'product_name' => 'required',
			'selling_price' => 'required',
			'kg' => 'required',
			'sale_date' => 'required',
			'quantity' => 'required'
		]);

		$input = $request->all();

		$items->fill($input)->save();

		Session::flash('flash_message', 'Billing successfully Updated!');

		return redirect()->route('Billing.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = Billing::findOrFail($id);

		$item->forceDelete();

		Session::flash('flash_message', 'Billing successfully deleted!');

		return redirect()->route('Billing.create');
	}

	public function getstock(Request $request)
	{
		$this->validate($request, [
			'product_code' => 'required'
		]);


		$input = $request->all();

		$product_code = $input['product_code'];

		$matchThese = [ 'product_code' => $product_code ];

		$purchaseditems = Purchase::Where($matchThese)->sum('quantity');
		$saleitems = Billing::Where($matchThese)->sum('quantity');
		$bal = $purchaseditems - $saleitems;
		echo $bal;
	}

}
