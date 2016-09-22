<?php namespace App\Http\Controllers;

use App\CompanyDetails;
use App\Settings;
use App\BillingFinalOthers;
use App\DateSeting;
use Excel;
use App\GroupMaster;
use DB;
use App\BillingOthers;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReportsOthersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$today = Carbon::now()->toDateString();

		$matchThese = ['sale_date' => $today];


		$totals = DB::table('billing_final_others')
				->select(DB::raw('SUM(total_kg) as total_kg'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(discount) as discount'))
				->Where($matchThese)
				->whereNull('deleted_at')
				->get();

		$items = BillingFinalOthers::withTrashed()->Where($matchThese)->orderby('id', 'desc')->Paginate(1000);



		$products = DB::table('billing_others')
				->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
				->where($matchThese)
				->orderby('product_name')
				->groupBy('product_code')
				->get();

		return view('ReportsOthers.index', compact('items', 'totals', 'products', 'today'));
	}

	public function reportbydate(Request $request)
	{

		$this->validate($request, [
				'reportbydatefrom' => 'required',
				'reportbydateto' => 'required'
		]);

		$input = $request->all();

		$from_date = $input["reportbydatefrom"];
		$to_date = $input["reportbydateto"];

		$totals = DB::table('billing_final_others')
				->select(DB::raw('SUM(total_kg) as total_kg'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(discount) as discount'))
				->whereBetween('sale_date',array($from_date,$to_date))
				->whereNull('deleted_at')
				->get();

		$items = BillingFinalOthers::withTrashed()
				->whereBetween('sale_date',array($from_date,$to_date))
				->orderby('id', 'desc')
				->Paginate(1000);

		$products = DB::table('billing_others')
				->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
				->whereBetween('sale_date',array($from_date,$to_date))
				->orderby('product_name')
				->groupBy('product_code')
				->get();


		return view('ReportsOthers.reportdata', compact('items', 'totals', 'products'));
	}

	public function reportbydateprint(Request $request)
	{

		$this->validate($request, [
				'reportbydatefrom' => 'required',
				'reportbydateto' => 'required'
		]);

		$input = $request->all();

		$from_date = $input["reportbydatefrom"];
		$to_date = $input["reportbydateto"];

		$totals = DB::table('billing_final_others')
				->select(DB::raw('SUM(total_kg) as total_kg'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(discount) as discount'))
				->whereBetween('sale_date',array($from_date,$to_date))
				->whereNull('deleted_at')
				->get();

		$items = BillingFinalOthers::withTrashed()
				->whereBetween('sale_date',array($from_date,$to_date))
				->orderby('id', 'asc')
				->Paginate(1000);

		$products = DB::table('billing_others')
				->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
				->whereBetween('sale_date',array($from_date,$to_date))
				->orderby('product_name')
				->groupBy('product_code')
				->get();
		$settings = Settings::first();
		$company = CompanyDetails::first();

		return view('ReportsOthers.reportdataprint', compact('items', 'totals', 'products', 'from_date', 'to_date', 'settings', 'company'));
	}


	public function ShowReports(Request $request)
	{
		$this->validate($request, [
				'from_date' => 'required',
				'to_date' => 'required'
		]);

		$input = $request->all();

		$from_date = date("Y-m-d", strtotime($input["from_date"]));
		$to_date = date("Y-m-d", strtotime($input["to_date"]));

		$items = DateSeting::all()->last()->id;
		$items = DateSeting::findOrFail($items);


		$items->fill($input)->save();


		$groupmasters = GroupMaster::all();
		foreach ($groupmasters as $row) {
			$group_name = $row->group_name;
			$tax_percentage = $row->tax_percentage;

			$result = DB::select('SELECT sum(quantity) as quantity, sum(total) as total, group_name, product_name, selling_price, measuring_type FROM billing_others WHERE sale_date BETWEEN "' . $from_date . '" AND "' . $to_date . '" AND group_name = "' . $group_name . '" GROUP BY product_code ');


			if (!empty($result)) {
				echo '<div class="col-md-6 col-md-offset-3">';
				echo '<h3 class="text-danger">Tax Type: ' . $group_name . '</h3>';
				echo '<table class="table table-bordered table-condensed table-hover table-responsive">
								<thead class="alert-warning">
									<th>Item Name</th>
									<th class="text-right">Price</th>
									<th class="text-right">Qty/Kgs Sales</th>
									<th class="text-right">Total</th>
								</thead>
								 <tbody id="datas">';

				$qty_total = 0;
				$price_total = 0;
				foreach ($result as $rows) {
					$qty_total = $qty_total + $rows->quantity;
					$price_total = $price_total + $rows->total;

					echo " <tr>";
					echo "<td>" . $rows->product_name . "</td>";
					echo "<td class='text-right'>" . $rows->selling_price . "</td>";
					echo "<td class='text-right'>" . $rows->quantity . " " . $rows->measuring_type . "</td>";
					echo "<td class='text-right'>" . $rows->total . "</td>";
					echo "</tr>";
				}
				echo " <tr>";
				echo "<td></td>";
				echo "<td class='text-right text-info'><b>Total: </b></td>";
				echo "<td class='text-right text-info'><b>" . $qty_total . "</b></td>";
				echo "<td class='text-right text-info'><b>" . $price_total . "</b></td>";
				echo "</tr>";

				echo " <tr>";
				echo "<td></td>";
				echo "<td class='text-right text-info'><b>Tax To Pay: </b></td>";
				echo "<td class='text-right text-info'><b></b></td>";
				echo "<td class='text-right text-info'><b>" . ($price_total * $tax_percentage) / 100 . "</b></td>";
				echo "</tr>";

				echo '</tbody>
							</table>';

				echo '<br/>';
				echo '<br/>';
				echo '</div>';
			}
		}
	}

	public function DownloadReports(Request $request)
	{
		$items = DateSeting::all();

		foreach($items as $row){
			$from_date 	=	$row->from_date;
			$to_date 	=	$row->to_date;
		}

		$result = '';
		$group_name = '';
		$groupmasters = GroupMaster::all();
		$i = 0;
		foreach ($groupmasters as $row) {

			${'group_name' . $i} = $row->group_name;
			${'tax_percentage' . $i} = $row->tax_percentage;

			${'result' . $i} =  DB::select('SELECT sum(quantity) as quantity, sum(total) as total, group_name, product_name, selling_price, measuring_type FROM billing_others WHERE sale_date BETWEEN "' . $from_date . '" AND "' . $to_date . '" AND group_name = "' . ${'group_name' . $i} . '" GROUP BY product_code ');

			$i++;
		}


		Excel::create('SalesReport', function($excel) use($items, $result0, $result1, $result2, $group_name0, $group_name1, $group_name2, $tax_percentage0, $tax_percentage1, $tax_percentage2, $from_date, $to_date ) {

			$excel->sheet('SalesReport', function ($sheet) use($items, $result0, $result1, $result2, $group_name0, $group_name1, $group_name2, $tax_percentage0, $tax_percentage1, $tax_percentage2, $from_date, $to_date) {

				$sheet->loadView('ReportsOthers.download',  compact('result0', 'result1', 'result2', 'items', 'group_name0', 'group_name1', 'group_name2', 'tax_percentage0', 'tax_percentage1', 'tax_percentage2', 'from_date', 'to_date'));

			});

		})->store('xls');

		echo '<h1>Check the folder "storage/exports" for downloaded reports</h1>';
	}
}