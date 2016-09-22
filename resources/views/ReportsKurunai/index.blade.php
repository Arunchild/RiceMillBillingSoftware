@extends('layouts.master')

@section('content')

    <div class="col-md-12 text-center"><h1>Today Summary</h1></div>
    <br/>
    <div class="col-md-1">Change</div>
    <div class="col-md-1">From:</div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-md-2"><input type="date" value={{ $today }} class="form-control" id="reportbydatefrom"/></div>
    <div class="col-md-1">To:</div>
    <div class="col-md-2"><input type="date" value={{ $today }} class="form-control" id="reportbydateto"/></div>

    <div class="col-md-2"><button type="button" class="btn-success form-control" id="reportbydatekurunai">View</button></div>
    <div class="col-md-2"><button type="button" class="btn-danger form-control" id="reportbydateprintkurunai">Print</button></div>

    <div class="clearfix"></div>
    <br/>
    <div class="report-data">
        <div class="col-md-12">
            <table class="table table-bordered table-condensed table-hover table-responsive">
                <thead class="alert-warning">
                <th>Sale date</th>
                <th>Bill Number</th>
                <th class="text-right">Total Kg</th>
                <th class="text-right">Total Amt</th>
                <th class="text-right">Discount</th>
                <th class="text-right">Net Total</th>
                </thead>

                <tbody>
                    @foreach($items as $item)
                        @if($item->trashed())
                            <tr class="">
                                <td><strike>{{ $item->sale_date->format('d-m-Y') }}</strike></td>
                                <td><strike>{{ $item->bill_number }}</strike> (CANCELLED BILL)</td>
                                <td class="text-right"><strike>{{ $item->grand_total }}</td>
                                <td class="text-right"><strike>{{ $item->discount }}</td>
                                <td class="text-right"><strike>{{ number_format($item->grand_total - $item->discount, 2, '.', '') }}</td>

                            </tr>
                        @else
                            <tr>
                                <td class="success">{{ $item->sale_date->format('d-m-Y') }}</td>
                                <td class="success">{{ $item->bill_number }}</td>
                                <td class="danger text-right">{{ $item->total_kg }} kg</td>
                                <td class="danger text-right">{{ $item->grand_total }}</td>
                                <td class="danger text-right">{{ $item->discount }}</td>
                                <td class="success text-right">{{ number_format($item->grand_total - $item->discount, 2, '.', '') }}</td>
                            </tr>
                        @endif
                    @endforeach

                    @foreach($totals as $total)
                        <?php $grand_total = $total->grand_total; ?>
                        <tr>
                            <td class=""></td>
                            <td class="text-right text-danger"><b>Total : </b></td>
                            <td class="text-right text-danger"><b>{{ $total->total_kg }} kg</b></td>
                            <td class="text-right text-danger"><b>{{ $total->grand_total }}</b></td>
                            <td class="text-right text-danger"><b>{{ $total->discount }}</b></td>
                            <td class=" text-right text-danger"><b>{{ number_format($total->grand_total - $total->discount, 2, '.', '') }}</b></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <?php $quantity_grand_total = 0; $kgs_grand_total = 0; ?>

        @foreach($products as $product)
            <?php
                $kgs_grand_total = $kgs_grand_total + $product->kg * $product->quantity;
                $quantity_grand_total = $quantity_grand_total + $product->quantity;
            ?>
            <div class="row text-danger">
                <div class="col-md-3 text-right">{{ $product->product_name }} {{ $product->kg }}kg</div>
                <div class="col-md-1 text-right">{{ $product->selling_price }}</div>
                <div class="col-md-1 text-right">x</div>
                <div class="col-md-1 text-right">{{ $product->quantity }}</div>
                <div class="col-md-1 text-right">{{ $product->kg * $product->quantity }} kg</div>
                <div class="col-md-1 text-right">=</div>
                <div class="col-md-1 text-right">{{ $product->total }}</div>
            </div>
        @endforeach

        <div class="clearfix"></div>
        <div class="row">
            <div class="text-right col-md-2  col-md-offset-3"><b>Total</b></div>
            <div class="text-right col-md-1"><b>{{ $quantity_grand_total }}</b></div>
            <div class="text-right col-md-1"><b>{{ $kgs_grand_total }} kg</b></div>
            <div class="text-right col-md-1 col-md-offset-1"><b>{{ $grand_total }}</b></div>
        </div>
    </div>

@stop