<?php namespace App\Http\Controllers;

use App\CompanyDetails;
use App\Settings;
use Carbon\Carbon;
use App\Purchase;
use App\Billing;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductMaster;
use Illuminate\Http\Request;
use DB;

class StockController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$today = Carbon::now()->toDateString();

		$matchThese = ['sale_date' => $today];

		$products = ProductMaster::select('product_name as label', 'id as product_code', 'product_name as product_name', 'kg as kg', 'selling_price as selling_price')->get()->toJson();
		return view('Stock.index', compact('products', 'today'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$yesterday = Carbon::yesterday()->toDateString();
		$today = Carbon::now()->toDateString();

		$matchThese = ['sale_date' => $today];

		$products = ProductMaster::orderby('product_name', 'asc')->get();

		return view('Stock.create', compact('products', 'today', 'yesterday'));
	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'product_code' => 'required',
			'product_name' => 'required',
			'selling_price' => 'required'
		]);


		$input = $request->all();

		$product_code = $input['product_code'];

		$matchThese = [ 'product_code' => $product_code ];

		$purchaseditems = Purchase::Where($matchThese)->get();
		$saleitems = Billing::Where($matchThese)->get();
		$products = ProductMaster::select('product_name as label', 'id as product_code',  'product_name as product_name', 'kg as kg', 'selling_price as selling_price' )->get()->toJson();

		return view('Stock.index', compact('purchaseditems', 'saleitems', 'products'));
	}

	public function stockbydate(Request $request)
	{
		$this->validate($request, [
				'stockbydatefrom' => 'required',
				'stockbydateto' => 'required'
		]);

		$input = $request->all();

		$from_date = $input["stockbydatefrom"];
		$to_date = $input["stockbydateto"];

		$yesterday = Carbon::yesterday()->toDateString();
		$today = Carbon::now()->toDateString();

		$matchThese = ['sale_date' => $today];

		$products = ProductMaster::orderby('product_name', 'asc')->get();

		return view('Stock.stockdata', compact('products', 'today', 'yesterday', 'from_date', 'to_date'));
	}

	public function stockbydateprint(Request $request)
	{
		$this->validate($request, [
				'stockbydatefrom' => 'required',
				'stockbydateto' => 'required'
		]);

		$input = $request->all();

		$from_date = $input["stockbydatefrom"];
		$to_date = $input["stockbydateto"];

		$yesterday = Carbon::yesterday()->toDateString();
		$today = Carbon::now()->toDateString();

		$matchThese = ['sale_date' => $today];

		$products = ProductMaster::orderby('product_name', 'asc')->get();
		$settings = Settings::first();
		$company = CompanyDetails::first();

		return view('Stock.stockbydateprint', compact('products', 'today', 'yesterday', 'from_date', 'to_date', 'settings', 'company'));
	}

}
