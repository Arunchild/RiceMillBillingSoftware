@extends('layouts.masterforbill')

@section('content')
        <!-- AutoComplete for Company Names -->
<style>
    *{
        font-weight: bold;
    }
    table{
        font-size: 20px;
    }

    body .ui-autocomplete {
        /* font-family to all */

    }

    body .ui-autocomplete .ui-menu-item .ui-corner-all {

    }

    body .ui-autocomplete .ui-menu-item .ui-state-focus {
        background-color: yellow;
        /* selected <a> */
    }

    .ui-autocomplete {
        max-height: 300px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
        /* add padding to account for vertical scrollbar */
        padding-right: 20px;
    }


</style>
<script>
    function isInt(n) {
        return Number(n) === n && n % 1 === 0;
    }

    function isFloat(n) {
        return Number(n) === n && n % 1 !== 0;
    }
    $(function() {
        @if(isset($products))
            var products = {!! $products !!};
        @else
            var products = ["error"];
        @endif

        $( "#product_name" ).autocomplete({
            autoFocus: true,
            source: function(req, resp) {
                console.log(req);
                var results = [];
                if (isInt(parseInt(req.term)) || isFloat(parseFloat(req.term))) {
                    // Number entered, check MRP or Selling Price
                    console.log("Number found.");

                    $.each(products, function(k, v) {
                        var kg = v.kg.toString();
                        var selling_price = v.selling_price.toString();
                        if (kg == req.term || selling_price == Number(req.term).toFixed(2)){
                            results.push(products[k]);
                        }
                    });
                } else {
                    //Text entered, check labels
                    console.log("Text found.");
                    $.each(products, function(k, v) {
                        var label = v.label.toLowerCase();
                        if (label.startsWith(req.term.toLowerCase())) {
                            results.push(products[k]);
                        }
                    });
                }
                resp(results);
            },
            focus: function(event, ui){
                $('.balance').text(ui.item.in_stock);
            },
            minLength: 0,
           /* focus: function(event, ui){
                $('#product_name').val(ui.item.product_name);
                $('#kg').val(ui.item.kg);
                $('#selling_price').val(ui.item.selling_price);
            },*/
            select: function(event, ui) {
                $('#product_code').val(ui.item.product_code);
                $('#product_name').val(ui.item.product_name);
                //$('#kg').val(ui.item.kg);
                $('#selling_price').val(ui.item.selling_price);
                $('#quantity').focus();
            }
        }).focus(function(){
            $(this).autocomplete("search", "");
        });

        $("#product_name").autocomplete().data("uiAutocomplete")._renderItem =  function( ul, item )
        {
            return $( "<li>" )
                    .append( "<a>" + item.label +" -"+ item.kg +"kg - Rs." + item.selling_price + "</a>" )
                    .appendTo( ul );
        };

        $(document).on("focus", "#selling_price", function(){
            $("#selling_price").select();
        });
        $(document).on("focus", "#quantity", function(){
            $("#quantity").select();
        });

    });
</script>

    @include('partials.alerts.errors')

    {!! Form::open([
        'route' => 'BillingOthers.store', 'id' => 'BillingForm'
    ]) !!}

    <div class="col-md-2 hidden">{!! Form::input('text', 'sale_date', date('d-m-Y'), array('id' => 'sale_date', 'class' => 'datepicker form-control TabOnEnter', 'placeholder' => 'sale_date')) !!}</div>

    <div class="col-md-3 hidden-print">
        <div class="input-group">
            {!! Form::input('text', 'product_name', null, array('id' => 'product_name', 'class' => 'input-lg form-control', 'placeholder' => 'product_name', 'autofocus')) !!}
            <span class="input-group-addon">Name</span>
        </div>
    </div>

    <div class="col-md-1  hidden-print">
        <div class="input-group">
            <span class="input-group-addon">Code</span>
            {!! Form::input('text', 'product_code', null, array('id' => 'product_code', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'product_code', 'readonly')) !!}
        </div>
    </div>


    <div class="col-md-2  hidden-print">
        <div class="input-group">
            <span class="input-group-addon">Bill No </span>
            {!! Form::input('text', 'bill_number', $bill_number, array('id' => 'bill_number', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'bill_number', 'readonly')) !!}
        </div>
    </div>


    <div class="col-md-2 hidden-print">
        <div class="input-group">
            <span class="input-group-addon">Rs</span>
            {!! Form::input('text', 'selling_price', null, array('id' => 'selling_price', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'price', 'tabindex' => 3)) !!}
        </div>
    </div>

    <div class="col-md-2 hidden-print">
        <div class="input-group">
            {!! Form::input('number', 'quantity', 1, array('id' => 'quantity', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'quantity', 'tabindex' => 4)) !!}
            <span class="available input-group-addon"></span>
        </div>
    </div>

    <div class="col-md-1 hidden-print">
        {!! Form::button('ADD', array('class' => 'btn-lg AddBillItem btn btn-primary TabOnEnter', 'tabindex' => 5)) !!}
    </div>

    {!! Form::close() !!}

    <div class="clearfix"></div>
    <!-- Product display area-->
<br/>
<br/>
<!-- bill formatting for inject printer -->

    <div class="row">
        @foreach($company as $row)
            <div class="col-md-12 visible-print">
              <h3 class="text-capitalize text-center">{{ $row->billingname }}</h3>
                <p class="text-center">{{ $row->addressline1 }}, {{ $row->addressline2 }}</p>
            </div>
        @endforeach
    </div>

    <div class="col-md-3">

    </div>
    <div class="col-md-9">
        <table class="table table-bordered table-condensed table-hover table-responsive">
            <thead class="alert-info">
                <th>Item Name</th>
                <th class="text-right">Price</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Total KG</th>
                <th class="text-right">Total Amt</th>
                <th class="text-center hidden-print">Delete</th>
            </thead>

            <tbody>

            <!-- variable declaration -->
            <?php $total_kg_grand_total = 0; $total_kg = 0; $quantity = 0; $quantity_grand_total = 0; ?>

            @foreach($items as $item)
                <?php
                    $total_kg = $item->kg * $item->quantity;
                    $total_kg_grand_total = $total_kg_grand_total + $total_kg;
                    $quantity = $item->quantity;
                    $quantity_grand_total = $quantity_grand_total + $quantity;
                ?>
                <tr>
                    <td>{{ $item->product_name }} {{ $item->kg }}kg</td>
                    <td class="text-right">{{ $item->selling_price }}</td>
                    <td class="text-right">{{ $quantity }}</td>
                    <td class="text-right">{{ $total_kg }} kg</td>
                    <td class="text-right">{{ number_format($item->selling_price * $item->quantity, 2, '.', '') }}</td>
                    <td class="text-center hidden-print">
                        {!! Form::open([
                           'method' => 'DELETE',
                           'route' => ['BillingOthers.destroy', $item->id]
                       ]) !!}

                        {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}

                        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach

            <tr>
                <td></td>
                <td class="text-right">NET:</td>
                <td class="text-right">{{ $quantity_grand_total }}</td>
                <td class="text-right">{{ $total_kg_grand_total }} kg</td>
                <td class="text-right"><h1><b>{{ $sum }}</b></h1></td>
                <td class="hidden-print"></td>
            </tr>

            </tbody>
        </table>
    </div>

<div class="clearfix"></div>

<div style="position: absolute; bottom:10px;" class="col-md-5 hidden-print">
    <h1 class="text-danger">Stock Available: <span style="font-size: 70px;" class="balance"></span></h1>
</div>

<div style="position: absolute; bottom:10px; right:0px;" class="col-md-3 hidden-print">
    <h1 class="text-danger">Last bill amt: <span style="font-size: 70px;" class="bill_amt">{{ $old_net_amount }}</span></h1>
</div>

{!! Form::open([
    'route' => 'BillingFinalOthers.store', 'id' => 'billingfinalform'
]) !!}


<div class="col-md-2 hidden">
    <div class="input-group">
        <span class="input-group-addon">Bill No </span>
        {!! Form::input('text', 'bill_number', $bill_number, array('id' => 'bill_number', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'bill_number', 'readonly')) !!}
    </div>
</div>

<div class="col-md-2 hidden">
    <div class="input-group">
        <span class="input-group-addon">total_kg </span>
        {!! Form::input('text', 'total_kg', $total_kg_grand_total, array('id' => 'total_kg', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'total_kg', 'readonly')) !!}
    </div>
</div>

<div class="col-md-2 hidden">
    <div class="input-group">
        <span class="input-group-addon">grand_total </span>
        {!! Form::input('text', 'grand_total', $sum, array('id' => 'grand_total', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'grand_total', 'readonly')) !!}
    </div>
</div>

<div class="col-md-2 hidden">{!! Form::input('text', 'sale_date', date('d-m-Y'), array('id' => 'sale_date', 'class' => 'datepicker form-control TabOnEnter', 'placeholder' => 'sale_date')) !!}</div>

<div class="col-md-1 col-md-offset-10">
    {!! Form::button('Finish', array('class' => 'btn-lg billingfinalformclass btn btn-primary hidden-print')) !!}
</div>

{!! Form::close() !!}

@stop