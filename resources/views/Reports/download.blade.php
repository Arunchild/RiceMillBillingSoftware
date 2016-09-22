@extends('layouts.simple')

@section('content')

    <div class="data-area">

        <div class="col-md-6 col-md-offset-3">
            @if (!empty($result0))
                <h3 class="text-danger">Tax Type: {{ $group_name0 }}</h3>
                <table class="table table-bordered table-condensed table-hover table-responsive">
                    <thead class="alert-warning">
                    <tr>
                        <th>Item Name</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Qty/Kgs Sales</th>
                        <th class="text-right">Total</th>
                    </tr>
                    </thead>
                    <tbody id="datas">

                    <?php $qty_total = 0;
                    $price_total = 0; ?>

                    @foreach ($result0 as $rows)
                        <?php $qty_total = $qty_total + $rows->quantity;
                        $price_total = $price_total + $rows->total; ?>

                        <tr>
                            <td>{{ $rows->product_name }} </td>
                            <td class='text-right'>{{ $rows->selling_price }}</td>
                            <td class='text-right'>{{ $rows->quantity . " " . $rows->measuring_type }}</td>
                            <td class='text-right'>{{  $rows->total }}</td>
                        </tr>

                    @endforeach

                    <tr>
                        <td></td>
                        <td class='text-right text-info'><b>Total: </b></td>
                        <td class='text-right text-info'><b>{{ $qty_total }}</b></td>
                        <td class='text-right text-info'><b>{{ $price_total }}</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class='text-right text-info'><b>Tax To Pay: </b></td>
                        <td class='text-right text-info'></td>
                        <td class='text-right text-info'><b>{{ ($price_total * $tax_percentage0) / 100 }}</b></td>
                    </tr>


                    </tbody>
                </table>

            @endif


            @if (!empty($result1))
                <h3 class="text-danger">Tax Type: {{ $group_name1 }}</h3>
                <table class="table table-bordered table-condensed table-hover table-responsive">
                    <thead class="alert-warning">
                    <tr>
                        <th>Item Name</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Qty/Kgs Sales</th>
                        <th class="text-right">Total</th>
                    </tr>
                    </thead>
                    <tbody id="datas">

                    <?php   $qty_total = 0;
                    $price_total = 0; ?>

                    @foreach ($result1 as $rows)
                        <?php $qty_total = $qty_total + $rows->quantity;
                        $price_total = $price_total + $rows->total; ?>

                        <tr>
                            <td>{{ $rows->product_name }} </td>
                            <td class='text-right'>{{ $rows->selling_price }}</td>
                            <td class='text-right'>{{ $rows->quantity . " " . $rows->measuring_type }}</td>
                            <td class='text-right'>{{  $rows->total }}</td>
                        </tr>

                    @endforeach

                    <tr>
                        <td></td>
                        <td class='text-right text-info'><b>Total: </b></td>
                        <td class='text-right text-info'><b>{{ $qty_total }}</b></td>
                        <td class='text-right text-info'><b>{{ $price_total }}</b></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class='text-right text-info'><b>Tax To Pay: </b></td>
                        <td class='text-right text-info'></td>
                        <td class='text-right text-info'><b>{{ ($price_total * $tax_percentage1) / 100 }}</b></td>
                    </tr>

                    </tbody>
                </table>

            @endif

            @if (!empty($result2))
                <h3 class="text-danger">Tax Type: {{ $group_name2 }}</h3>
                <table class="table table-bordered table-condensed table-hover table-responsive">
                    <thead class="alert-warning">
                    <tr>
                        <th>Item Name</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Qty/Kgs Sales</th>
                        <th class="text-right">Total</th>
                    </tr>
                    </thead>
                    <tbody id="datas">

                    <?php  $qty_total = 0;
                    $price_total = 0; ?>

                    @foreach ($result2 as $rows)
                        <?php $qty_total = $qty_total + $rows->quantity;
                        $price_total = $price_total + $rows->total; ?>

                        <tr>
                            <td>{{ $rows->product_name }} </td>
                            <td class='text-right'>{{ $rows->selling_price }}</td>
                            <td class='text-right'>{{ $rows->quantity . " " . $rows->measuring_type }}</td>
                            <td class='text-right'>{{  $rows->total }}</td>
                        </tr>

                    @endforeach

                    <tr>
                        <td></td>
                        <td class='text-right text-info'><b>Total: </b></td>
                        <td class='text-right text-info'><b>{{ $qty_total }}</b></td>
                        <td class='text-right text-info'><b>{{ $price_total }}</b></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class='text-right text-info'><b>Tax To Pay: </b></td>
                        <td class='text-right text-info'></td>
                        <td class='text-right text-info'><b>{{ ($price_total * $tax_percentage2) / 100 }}</b></td>
                    </tr>


                    </tbody>
                </table>

            @endif
            <br/>
            <br/>
        </div>

    </div>

@stop