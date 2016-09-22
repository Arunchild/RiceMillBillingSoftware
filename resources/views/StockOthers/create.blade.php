@extends('layouts.master')

@section('content')
    <style>
       *{
           font-weight:bold;
       }
    </style>

        <!-- AutoComplete for Company Names -->
<?php $purchase_qty_grand_total = 0; $sales_qty_grand_total = 0; $opening_grandtotal = 0;
$purchase_qty_grand_total_op = 0;
$sales_qty_grand_total_op = 0;
$purchase_kgs_grand_total = 0;
$sales_kgs_grand_total = 0;
$opening_kgs_grand_total = 0;
?>
<h3 class="text-center">Stock Others - BRAND WISE</h3>
<hr>

@include('partials.alerts.errors')

<div class="clearfix"></div>
    <br/>
    <div class="col-md-1">Change</div>
    <div class="col-md-1">From:</div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-md-2"><input type="date" value={{ $today }} class="form-control" id="stockbydatefrom"/></div>
    <div class="col-md-1">To:</div>
    <div class="col-md-2"><input type="date" value={{ $today }} class="form-control" id="stockbydateto"/></div>

    <div class="col-md-2"><button type="button" class="btn-success form-control" id="stockbydate">View</button></div>
    <div class="col-md-2"><button type="button" class="btn-danger form-control" id="stockbydateprint">Print</button></div>

<!-- Product display area-->
<br/>
<br/>
<div id="stockdata">
    <div class="col-md-12">
        <table class="table table-bordered table-condensed table-hover table-responsive">
            <thead class="alert-warning">
            <th>Code</th>
            <th>Item Name</th>
            <th class="text-right">KG</th>
            <th class="text-right">Opening</th>
            <th class="text-right">Purchase Quantity</th>
            <th class="text-right">Purchase Kgs</th>
            <th class="text-right">Sales Quantity</th>
            <th class="text-right">Sales Kgs</th>
            <th class="text-right">Bal Qty</th>
            <th class="text-right">Bal Kg</th>
            </thead>

            <tbody id="datas">
           <?php

           foreach ($products as $product) {
                $product_code = $product->id;
                $matchThese = ['product_code' => $product_code];


               //calculate previous days closing ie., todays opening

               $purchaseditems_op = DB::table('purchase_others')
                       ->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
                       ->where($matchThese)
                       ->where('sale_date', '<', $today)
                       ->orderby('id')
                       ->get();

               $saleitems_op = DB::table('billing_others')
                       ->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
                       ->where($matchThese)
                       ->where('sale_date', '<', $today)
                       ->orderby('id')
                       ->get();

               foreach ($purchaseditems_op as $purchased) {
                   $purchase_qty_op = $purchased->quantity;
                   $purchase_qty_grand_total_op = $purchase_qty_grand_total_op + $purchased->quantity;
               }
               foreach ($saleitems_op as $sale) {
                   $sale_qty_op = $sale->quantity;
                   $sales_qty_grand_total_op = $sales_qty_grand_total_op + $sale->quantity;
               }


               $opening = $purchase_qty_op - $sale_qty_op;
               $opening_grandtotal = $opening_grandtotal + $opening;


                $purchaseditems = DB::table('purchase_others')
                ->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
                ->where($matchThese)
                ->where('sale_date', '=', $today)
                ->orderby('id')
                ->get();

                $saleitems = DB::table('billing_others')
                ->select('*', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total) as total'))
                ->where($matchThese)
                ->where('sale_date', '=', $today)
                ->orderby('id')
                ->get();

                echo '<tr>
                    <td>' . $product->id . '</td>
                    <td>' . $product->product_name . '</td>
                    <td class="text-right">' . $product->kg . '</td>
                    <td class="text-right">' . $opening . '</td>';
					
					$opening_kgs_grand_total = $opening_kgs_grand_total + ($product->kg * $opening);

                    foreach ($purchaseditems as $purchased) {
                        $purchase_qty = $purchased->quantity;
                        $purchase_qty_grand_total = $purchase_qty_grand_total + $purchased->quantity;

                        $purchase_kgs_grand_total = $purchase_kgs_grand_total + ($product->kg * $purchased->quantity);

                    echo '<td class="text-right">' . $purchased->quantity . '</td>
                    <td class="text-right">' . ($product->kg * $purchased->quantity) . '</td>';
                    }
                    foreach ($saleitems as $sale) {
                        $sale_qty = $sale->quantity;
                        $sales_qty_grand_total = $sales_qty_grand_total + $sale->quantity;

                        $sales_kgs_grand_total = $sales_kgs_grand_total + ($product->kg * $sale->quantity);

                    echo '<td class="text-right">' . $sale->quantity . '</td>
                    <td class="text-right">' . $product->kg * $sale->quantity . '</td>';
                    }
                    $balance_qty = $opening + $purchase_qty - $sale_qty;
                    echo '<td class="text-right">' . ($opening + $purchase_qty - $sale_qty) . '</td>';
                    echo '<td class="text-right">' . $product->kg * $balance_qty . '</td>';
                    echo '</tr>';
                } ?>

                <tr class="alert-info">
                    <td></td>
                    <td></td>
                    <td class="text-right">Total: </td>
                    <td class="text-right"><b>{{ $opening_grandtotal }}</b></td>
                    <td class="text-right"><b>{{ $purchase_qty_grand_total }}</b></td>
                    <td class="text-right">{{ $purchase_kgs_grand_total }}</td>
                    <td class="text-right"><b>{{ $sales_qty_grand_total }}</b></td>
                    <td class="text-right">{{ $sales_kgs_grand_total }}</td>
                    <td></td>
                    <td></td>

                </tr>

                <tr class="alert-info">
                    <td></td>
                    <td></td>
                    <td class="text-right text-danger">Balance: </td>
                    <td class="text-right text-danger"></td>
                    <td></td>
                    <td class="text-right"></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><b>{{ $opening_grandtotal + $purchase_qty_grand_total - $sales_qty_grand_total }}</b></td>
                    <td class="text-right">{{ $purchase_kgs_grand_total + $opening_kgs_grand_total - $sales_kgs_grand_total }}</td>

            </tr>

            </tbody>
        </table>
    </div>
</div>
@stop