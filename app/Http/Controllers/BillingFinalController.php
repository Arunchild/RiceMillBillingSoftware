<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use App\CompanyDetails;
use App\Settings;
use DB;
use App\BillingFinal;
use App\Billing;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;

class BillingFinalController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$totals = DB::table('billing_finals')
			->select(DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(discount) as discount'))
			->get();

		$items = BillingFinal::withTrashed()->orderby('id', 'desc')->Paginate(1000);

		return view('BillingFinal.index', compact('items', 'totals'));
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
			'bill_number' => 'required',
			'grand_total' => 'required',
			'sale_date' => 'required'
		]);

		$input = $request->all();
        $grand_total = $input['grand_total'];

        if($grand_total <= 0)
        {
            Session::flash('flash_message', 'Enter any items!');

            //TODO: redirect to Party list page
            return redirect()->route('Billing.create');
        }

		BillingFinal::create($input);

		//Collectiong needed details


        $bill_number = $input['bill_number'];
        $matchThese = ['bill_number' => $bill_number];

        $item_count = 0;
        $company = CompanyDetails::first();
        $final = BillingFinal::Where($matchThese)->first();
        $products = Billing::Where($matchThese)->get();
        $settings = Settings::first();
$date = Carbon::now()->toDateString();
    //Printing here
for($c=0; $c< $settings->copy; $c++){

	//printer font, other settings

		//bold text on and off
		$boldon = chr(27)."E".chr(1);
		$boldoff = chr(27)."F".chr(0);

		//15pt size
			$fifteen = chr(27)."g";

		//12pt size
			$twlve = chr(27)."M".chr(1);
		//10pt size
			$ten = chr(27)."P".chr(1);

		//double width printing on and off
			$bigwidth = chr(27)."W".chr(1);
			$bigoff = chr(27)."W".chr(0);

		//double height printing on and off
			$bighon = chr(27)."w".chr(1);
			$bighoff = chr(27)."w".chr(0);

		//center
			$center =   chr(27)."a".chr(1);
		//double line
			$doubleline =   chr(27)."("."-".chr(3).chr(0).chr(1).chr(1).chr(2);
			$doublelineoff =   chr(27)."("."-".chr(3).chr(0).chr(1).chr(1).chr(0);
		//underline
			$underline      =   chr(27)."-".chr(1);
			$underlineoff   =   chr(27)."-".chr(0);

        $handle = printer_open($settings->printer_name);
	if($handle)
	{
			printer_start_doc($handle, "BILLING");
			printer_set_option($handle,PRINTER_PAPER_FORMAT,PRINTER_FORMAT_CUSTOM);
			printer_set_option($handle,PRINTER_PAPER_LENGTH,153);
			printer_set_option($handle,PRINTER_PAPER_WIDTH,254);

			// Set print mode to RAW and send PDF to printer
			printer_set_option($handle, PRINTER_MODE, "RAW");
			


			if ($settings->preprint_space > 0) {
				for ($i = 0; $i < $settings->preprint_space; $i++) {
					printer_write($handle, "\n");
				}
			} else {
				printer_write($handle, str_pad(".", 40, " ", STR_PAD_LEFT));
				printer_write($handle, "\n");
				printer_write($handle, $boldon.$bighon.str_pad($company->companyname, 40, " ", STR_PAD_BOTH));
				printer_write($handle, "\n");
				printer_write($handle, "\n");

				$item_count = $item_count + 3;

				printer_write($handle, $bighoff.str_pad($company->addressline1. ", " .$company->addressline2, 40, " ", STR_PAD_BOTH));
				printer_write($handle, "\n");
				printer_write($handle, $bighoff.str_pad($company->phone, 40, " ", STR_PAD_BOTH));
				printer_write($handle, "\n");


				printer_write($handle, $boldoff.$bigoff.str_pad("Bill No. " . $bill_number, 14, " ", STR_PAD_RIGHT).str_pad(" ", 10, " ", STR_PAD_BOTH).str_pad("Date: ".date('d-m-Y'), 16, " ", STR_PAD_LEFT));
				printer_write($handle, "\n");

				printer_write($handle, str_pad("-", 40, "-", STR_PAD_BOTH));
				printer_write($handle, "\n");

				printer_write($handle, str_pad("ITEM", 20, " ", STR_PAD_RIGHT) . "" . str_pad("PRICE", 7, " ", STR_PAD_LEFT)."  " . str_pad("QTY", 3, " ", STR_PAD_BOTH) . str_pad("AMOUNT", 8, " ", STR_PAD_LEFT));
				printer_write($handle, "\n");
				printer_write($handle, str_pad("-", 40, "-", STR_PAD_BOTH));
				printer_write($handle, "\n");


				$item_count = $item_count + 6;
			}

		$total_kg_grand_total = 0; $total_kg = 0; $quantity = 0; $quantity_grand_total = 0;

		foreach ($products as $row) {

			$total_kg = $row->kg * $row->quantity;
			$total_kg_grand_total = $total_kg_grand_total + $total_kg;
			$quantity = $row->quantity;
			$quantity_grand_total = $quantity_grand_total + $quantity;

			$product_name = str_split(trim($row->product_name), 14);

			//PRINTING ITEMS
			printer_write($handle, str_pad($product_name[0] . " " . $row->kg . "kg", 20, " ", STR_PAD_RIGHT) . "" . str_pad($row->selling_price, 7, " ", STR_PAD_LEFT) . "  " . str_pad($quantity, 3, " ", STR_PAD_BOTH)."" . str_pad($row->total, 8, " ", STR_PAD_LEFT) . "\n");
			$item_count = $item_count + 1;

			if(!empty($product_name[1])){
				printer_write($handle, str_pad($product_name[1], 14, " ", STR_PAD_RIGHT)."\n");
				$item_count = $item_count + 1;
			}
		}

		$grandtotal = str_pad($final->grand_total, 8, " ", STR_PAD_LEFT);
		printer_write($handle, str_pad(" ", 32, " ", STR_PAD_LEFT) . str_pad("-", 8, "-", STR_PAD_LEFT));
		printer_write($handle, "\n");
		printer_write($handle, str_pad("NET Total :   ", 27, " ", STR_PAD_LEFT)."  ".str_pad($quantity_grand_total, 3, " ", STR_PAD_BOTH).str_pad($grandtotal, 8, " ", STR_PAD_LEFT));
		printer_write($handle, "\n");
		$item_count = $item_count + 2;


		printer_write($handle, str_pad("-", 40, "-", STR_PAD_BOTH));
		printer_write($handle, "\n");
		$item_count = $item_count + 1;

		//ROLL OVER TO NEXT PAGE
		$item_count_remaining = 36 - $item_count;

		for($i=0; $i<$item_count_remaining; $i++){
			printer_write($handle, "\n");
		}
		
		printer_close($handle);
	}
}

		Session::flash('flash_message', 'Billing successfully added!');

		//TODO: redirect to Party list page
		return redirect()->route('Billing.create');
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
		$finaldatas = BillingFinal::find($id);

		//getting items belongs to this bill:
		$matchThese = ['bill_number' => $finaldatas->bill_number, 'sale_date' => $finaldatas->sale_date->format('Y-m-d')];

		$items = Billing::Where($matchThese)->get();
		$sum = Billing::Where($matchThese)->sum('total');

		$bill_number = $finaldatas->bill_number;
		$matchThese = ['bill_number' => $bill_number];

		$item_count = 0;
		$company = CompanyDetails::first();
		$final = BillingFinal::Where($matchThese)->first();
		$products = Billing::Where($matchThese)->get();
		$settings = Settings::first();
		$date = Carbon::now()->toDateString();
		//Printing here
	/*	for($c=0; $c< $settings->copy; $c++){

			//printer font, other settings

			//bold text on and off
			$boldon = chr(27)."E".chr(1);
			$boldoff = chr(27)."F".chr(0);

			//15pt size
			$fifteen = chr(27)."g";

			//12pt size
			$twlve = chr(27)."M".chr(1);
			//10pt size
			$ten = chr(27)."P".chr(1);

			//double width printing on and off
			$bigwidth = chr(27)."W".chr(1);
			$bigoff = chr(27)."W".chr(0);

			//double height printing on and off
			$bighon = chr(27)."w".chr(1);
			$bighoff = chr(27)."w".chr(0);

			//center
			$center =   chr(27)."a".chr(1);
			//double line
			$doubleline =   chr(27)."("."-".chr(3).chr(0).chr(1).chr(1).chr(2);
			$doublelineoff =   chr(27)."("."-".chr(3).chr(0).chr(1).chr(1).chr(0);
			//underline
			$underline      =   chr(27)."-".chr(1);
			$underlineoff   =   chr(27)."-".chr(0);

			$handle = printer_open($settings->printer_name);
			if($handle)
			{
				printer_start_doc($handle, "BILLING");
				printer_set_option($handle,PRINTER_PAPER_FORMAT,PRINTER_FORMAT_CUSTOM);
				printer_set_option($handle,PRINTER_PAPER_LENGTH,153);
				printer_set_option($handle,PRINTER_PAPER_WIDTH,254);

				// Set print mode to RAW and send PDF to printer
				printer_set_option($handle, PRINTER_MODE, "RAW");



				if ($settings->preprint_space > 0) {
					for ($i = 0; $i < $settings->preprint_space; $i++) {
						printer_write($handle, "\n");
					}
				} else {
					printer_write($handle, $boldon.$bighon.str_pad($company->companyname, 40, " ", STR_PAD_BOTH));
					printer_write($handle, "\n");
					printer_write($handle, "\n");

					$item_count = $item_count + 2;

					printer_write($handle, $bighoff.str_pad($company->addressline1. ", " .$company->addressline2, 40, " ", STR_PAD_BOTH));
					printer_write($handle, "\n");
					printer_write($handle, $bighoff.str_pad($company->phone, 40, " ", STR_PAD_BOTH));
					printer_write($handle, "\n");


					printer_write($handle, $boldoff.$bigoff.str_pad("Bill No. " . $bill_number, 14, " ", STR_PAD_RIGHT).str_pad(" ", 10, " ", STR_PAD_BOTH).str_pad("Date: ".date('d-m-Y'), 16, " ", STR_PAD_LEFT));
					printer_write($handle, "\n");

					printer_write($handle, str_pad("-", 40, "-", STR_PAD_BOTH));
					printer_write($handle, "\n");

					printer_write($handle, str_pad("ITEM", 20, " ", STR_PAD_RIGHT) . "" . str_pad("PRICE", 7, " ", STR_PAD_LEFT)."  " . str_pad("QTY", 3, " ", STR_PAD_BOTH) . str_pad("AMOUNT", 8, " ", STR_PAD_LEFT));
					printer_write($handle, "\n");
					printer_write($handle, str_pad("-", 40, "-", STR_PAD_BOTH));
					printer_write($handle, "\n");


					$item_count = $item_count + 6;
				}

				$total_kg_grand_total = 0; $total_kg = 0; $quantity = 0; $quantity_grand_total = 0;

				foreach ($products as $row) {

					$total_kg = $row->kg * $row->quantity;
					$total_kg_grand_total = $total_kg_grand_total + $total_kg;
					$quantity = $row->quantity;
					$quantity_grand_total = $quantity_grand_total + $quantity;

					$product_name = str_split(trim($row->product_name), 14);

					//PRINTING ITEMS
					printer_write($handle, str_pad($product_name[0] . " " . $row->kg . "kg", 20, " ", STR_PAD_RIGHT) . "" . str_pad($row->selling_price, 7, " ", STR_PAD_LEFT) . "  " . str_pad($quantity, 3, " ", STR_PAD_BOTH)."" . str_pad($row->total, 8, " ", STR_PAD_LEFT) . "\n");
					$item_count = $item_count + 1;

					if(!empty($product_name[1])){
						printer_write($handle, str_pad($product_name[1], 14, " ", STR_PAD_RIGHT)."\n");
						$item_count = $item_count + 1;
					}
				}

				$grandtotal = str_pad($final->grand_total, 8, " ", STR_PAD_LEFT);
				printer_write($handle, str_pad(" ", 32, " ", STR_PAD_LEFT) . str_pad("-", 8, "-", STR_PAD_LEFT));
				printer_write($handle, "\n");
				printer_write($handle, str_pad("NET Total :   ", 27, " ", STR_PAD_LEFT)."  ".str_pad($quantity_grand_total, 3, " ", STR_PAD_BOTH).str_pad($grandtotal, 8, " ", STR_PAD_LEFT));
				printer_write($handle, "\n");
				$item_count = $item_count + 2;


				printer_write($handle, str_pad("-", 40, "-", STR_PAD_BOTH));
				printer_write($handle, "\n");
				$item_count = $item_count + 1;

				//ROLL OVER TO NEXT PAGE
				$item_count_remaining = 36 - $item_count;

				for($i=0; $i<$item_count_remaining; $i++){
					printer_write($handle, "\n");
				}
				printer_close($handle);
			}
		}*/

		return view('BillingFinal.show', compact('items', 'sum', 'finaldatas'));
	}

	public function bill_print(Request $request)
	{
		$input = $request->all();
		$id = $input['bill_print_id'];
		// get the nerd
		$finaldatas = BillingFinal::find($id);

		//getting items belongs to this bill:
		$matchThese = ['bill_number' => $finaldatas->bill_number, 'sale_date' => $finaldatas->sale_date->format('Y-m-d')];

		$items = Billing::Where($matchThese)->get();
		$sum = Billing::Where($matchThese)->sum('total');

		$bill_number = $finaldatas->bill_number;
		$matchThese = ['bill_number' => $bill_number];

		$item_count = 0;
		$company = CompanyDetails::first();
		$final = BillingFinal::Where($matchThese)->first();
		$products = Billing::Where($matchThese)->get();
		$settings = Settings::first();
		$date = Carbon::now()->toDateString();
		//Printing here
		for($c=0; $c< $settings->copy; $c++){

			//printer font, other settings

			//bold text on and off
			$boldon = chr(27)."E".chr(1);
			$boldoff = chr(27)."F".chr(0);

			//15pt size
			$fifteen = chr(27)."g";

			//12pt size
			$twlve = chr(27)."M".chr(1);
			//10pt size
			$ten = chr(27)."P".chr(1);

			//double width printing on and off
			$bigwidth = chr(27)."W".chr(1);
			$bigoff = chr(27)."W".chr(0);

			//double height printing on and off
			$bighon = chr(27)."w".chr(1);
			$bighoff = chr(27)."w".chr(0);

			//center
			$center =   chr(27)."a".chr(1);
			//double line
			$doubleline =   chr(27)."("."-".chr(3).chr(0).chr(1).chr(1).chr(2);
			$doublelineoff =   chr(27)."("."-".chr(3).chr(0).chr(1).chr(1).chr(0);
			//underline
			$underline      =   chr(27)."-".chr(1);
			$underlineoff   =   chr(27)."-".chr(0);

			$handle = printer_open($settings->printer_name);
			if($handle)
			{
				printer_start_doc($handle, "BILLING");
				printer_set_option($handle,PRINTER_PAPER_FORMAT,PRINTER_FORMAT_CUSTOM);
				printer_set_option($handle,PRINTER_PAPER_LENGTH,153);
				printer_set_option($handle,PRINTER_PAPER_WIDTH,254);

				// Set print mode to RAW and send PDF to printer
				printer_set_option($handle, PRINTER_MODE, "RAW");



				if ($settings->preprint_space > 0) {
					for ($i = 0; $i < $settings->preprint_space; $i++) {
						printer_write($handle, "\n");
					}
				} else {
					printer_write($handle, str_pad(".", 40, " ", STR_PAD_LEFT));
					printer_write($handle, "\n");
					printer_write($handle, $boldon.$bighon.str_pad($company->companyname, 40, " ", STR_PAD_BOTH));
					printer_write($handle, "\n");
					printer_write($handle, "\n");

					$item_count = $item_count + 3;

					printer_write($handle, $bighoff.str_pad($company->addressline1. ", " .$company->addressline2, 40, " ", STR_PAD_BOTH));
					printer_write($handle, "\n");
					printer_write($handle, $bighoff.str_pad($company->phone, 40, " ", STR_PAD_BOTH));
					printer_write($handle, "\n");
					printer_write($handle, "\n");


					printer_write($handle, $boldoff.$bigoff.str_pad("Bill No. " . $bill_number, 14, " ", STR_PAD_RIGHT).str_pad(" ", 10, " ", STR_PAD_BOTH).str_pad("Date: ".$finaldatas->sale_date->format('d-m-Y'), 16, " ", STR_PAD_LEFT));
					printer_write($handle, "\n");

					printer_write($handle, str_pad("-", 40, "-", STR_PAD_BOTH));
					printer_write($handle, "\n");

					printer_write($handle, str_pad("ITEM", 20, " ", STR_PAD_RIGHT) . "" . str_pad("PRICE", 7, " ", STR_PAD_LEFT)."  " . str_pad("QTY", 3, " ", STR_PAD_BOTH) . str_pad("AMOUNT", 8, " ", STR_PAD_LEFT));
					printer_write($handle, "\n");
					printer_write($handle, str_pad("-", 40, "-", STR_PAD_BOTH));
					printer_write($handle, "\n");


					$item_count = $item_count + 7;
				}

				$total_kg_grand_total = 0; $total_kg = 0; $quantity = 0; $quantity_grand_total = 0;

				foreach ($products as $row) {

					$total_kg = $row->kg * $row->quantity;
					$total_kg_grand_total = $total_kg_grand_total + $total_kg;
					$quantity = $row->quantity;
					$quantity_grand_total = $quantity_grand_total + $quantity;

					$product_name = str_split(trim($row->product_name), 14);

					//PRINTING ITEMS
					printer_write($handle, str_pad($product_name[0] . " " . $row->kg . "kg", 20, " ", STR_PAD_RIGHT) . "" . str_pad($row->selling_price, 7, " ", STR_PAD_LEFT) . "  " . str_pad($quantity, 3, " ", STR_PAD_BOTH)."" . str_pad($row->total, 8, " ", STR_PAD_LEFT) . "\n");
					$item_count = $item_count + 1;

					if(!empty($product_name[1])){
						printer_write($handle, str_pad($product_name[1], 14, " ", STR_PAD_RIGHT)."\n");
						$item_count = $item_count + 1;
					}
				}

				$grandtotal = str_pad($final->grand_total, 8, " ", STR_PAD_LEFT);
				$discount = str_pad($final->discount, 8, " ", STR_PAD_LEFT);
				$net_amount = str_pad($final->net_amount, 8, " ", STR_PAD_LEFT);

				printer_write($handle, str_pad(" ", 32, " ", STR_PAD_LEFT) . str_pad("-", 8, "-", STR_PAD_LEFT));
				printer_write($handle, "\n");
				$item_count = $item_count + 1;

				if($discount > 0){
					printer_write($handle, str_pad("Total :   ", 27, " ", STR_PAD_LEFT)."  ".str_pad($quantity_grand_total, 3, " ", STR_PAD_BOTH).str_pad($grandtotal, 8, " ", STR_PAD_LEFT));
					printer_write($handle, "\n");
					printer_write($handle, str_pad("Discount :   ", 27, " ", STR_PAD_LEFT)."  ".str_pad("(-)", 3, " ", STR_PAD_BOTH).str_pad($discount, 8, " ", STR_PAD_LEFT));
					printer_write($handle, "\n");
					printer_write($handle, str_pad("NET Total :   ", 27, " ", STR_PAD_LEFT)."  ".str_pad(" ", 3, " ", STR_PAD_BOTH).str_pad(number_format(($grandtotal-$discount), 2, '.', '' ), 8, " ", STR_PAD_LEFT));
					printer_write($handle, "\n");

					$item_count = $item_count + 3;
				}else{
					printer_write($handle, str_pad("NET Total :   ", 27, " ", STR_PAD_LEFT)."  ".str_pad($quantity_grand_total, 3, " ", STR_PAD_BOTH).str_pad($grandtotal, 8, " ", STR_PAD_LEFT));
					printer_write($handle, "\n");
					$item_count = $item_count + 1;
				}


				printer_write($handle, str_pad("-", 40, "-", STR_PAD_BOTH));
				printer_write($handle, "\n");
				$item_count = $item_count + 1;

				//ROLL OVER TO NEXT PAGE
				$item_count_remaining = 36 - $item_count;

				for($i=0; $i<$item_count_remaining; $i++){
					printer_write($handle, "\n");
				}
				printer_close($handle);
			}
		}

		//return view('BillingFinal.show', compact('items', 'sum', 'finaldatas'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$items = BillingFinal::findOrFail($id);
		return view('BillingFinal.edit', compact('items'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$items = BillingFinal::findOrFail($id);

		$this->validate($request, [
			'sale_date' => 'required',
			'bill_number' => 'required',
			'grand_total' => 'required',
			'discount' => 'required'
		]);

		$input = $request->all();

		$items->fill($input)->save();

		Session::flash('flash_message', 'Disount Given!');

		return redirect()->route('BillingFinal.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = BillingFinal::findOrFail($id);

		$bill_number = $item->bill_number;

		$matchThese = ['bill_number' => $bill_number];

		$products = Billing::Where($matchThese)->get();

		$item->delete();


		foreach($products as $product){
			$id = $product->id;
			$deletethisproduct = Billing::findOrFail($id);
			$deletethisproduct->forceDelete();
		}

		Session::flash('flash_message', 'Bill successfully deleted!');

		return redirect()->route('BillingFinal.index');
	}

}
