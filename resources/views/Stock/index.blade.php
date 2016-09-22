@extends('layouts.master')

@section('content')
        <?php $purchaseqty = 0; ?>
        <?php $saleqty = 0; ?>
        <!-- AutoComplete for Company Names -->
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
            minLength: 0,
            /* focus: function(event, ui){
             $('#product_name').val(ui.item.product_name);
             $('#kg').val(ui.item.kg);
             $('#selling_price').val(ui.item.selling_price);
             },*/
            select: function(event, ui) {
                $('#product_code').val(ui.item.product_code);
                $('#product_name').val(ui.item.product_name);
                $('#kg').val(ui.item.kg);
                $('#selling_price').val(ui.item.selling_price);
                $('#selling_price').focus();
            }
        }).focus(function(){
            $(this).autocomplete("search", "");
        });

        $("#product_name").autocomplete().data("uiAutocomplete")._renderItem =  function( ul, item )
        {
            return $( "<li>" )
                    .append( "<a>" + item.label +" -"+ item.kg +"kg - ₹" + item.selling_price + "</a>" )
                    .appendTo( ul );
        };

        $(document).on("focus", "#selling_price", function(){
            $("#selling_price").select();
        });

    });
</script>
<h3 class="text-center">Stock - View</h3>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'Stock.store', 'id' => 'BillingForm'
]) !!}

<div class="col-md-3 hidden-print">
    <div class="input-group">
        <span class="input-group-addon">Code</span>
        {!! Form::input('text', 'product_code', null, array('id' => 'product_code', 'class' => 'input-lg form-control', 'placeholder' => 'product_code')) !!}
    </div>
</div>


<div class="col-md-3 hidden-print">
    <div class="input-group">
        <span class="input-group-addon">Name</span>
        {!! Form::input('text', 'product_name', null, array('id' => 'product_name', 'class' => 'input-lg form-control', 'placeholder' => 'product_name', 'autofocus')) !!}
    </div>
</div>
<div class="col-md-2 hidden-print">
    <div class="input-group">
        <span class="input-group-addon">Rs</span>
        {!! Form::input('text', 'selling_price', null, array('id' => 'selling_price', 'class' => 'input-lg form-control', 'placeholder' => 'price')) !!}
    </div>
</div>

<div class="col-md-2 hidden">
    <div class="input-group">
        <span class="input-group-addon">Measuring Type</span>
        {!! Form::input('text', 'measuring_type', null, array('id' => 'measuring_type', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'measuring_type', 'tabindex' => 2)) !!}
    </div>
</div>

<div class="col-md-2 hidden">
    <div class="input-group">
        <span class="input-group-addon">Group Name</span>
        {!! Form::input('text', 'group_name', null, array('id' => 'group_name', 'class' => 'input-lg form-control', 'placeholder' => 'group_name')) !!}
    </div>
</div>

<div class="col-md-1 hidden-print">
    {!! Form::button('Show Stock', array('class' => 'btn-lg AddBillItem btn btn-primary TabOnEnter', 'tabindex' => 4)) !!}
</div>
{!! Form::close() !!}

<div class="clearfix"></div>
<!-- Product display area-->
<br/>
<br/>

<div class="col-md-12">
    <table class="table table-bordered table-condensed table-hover table-responsive">
        <thead class="alert-warning">
            <th>Code</th>
            <th>Item Name</th>
            <th class="text-right">Price</th>
            <th class="text-right">Purchase Quantity</th>
            <th class="text-right">Purchase Total</th>
            <th class="text-right">Sales Quantity</th>
            <th class="text-right">Sales Total</th>
        </thead>

        <tbody id="datas">
        @if(isset($purchaseditems))
          <?php $purchaseqty = 0; ?>
            @foreach($purchaseditems as $item)
                <?php $purchaseqty = $purchaseqty + $item->quantity; ?>
                <tr>
                    <td>{{ $item->product_code }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-right">{{ $item->selling_price }}</td>
                    <td class="text-right">{{ $item->quantity }} {{ $item->measuring_type }}</td>
                    <td class="text-right">{{ number_format($item->selling_price * $item->quantity, 2, '.', '') }}</td>
                    <td></td>
                    <td></td>

                </tr>
            @endforeach
         @endif

        @if(isset($saleitems))
            <?php $saleqty = 0; ?>
            @foreach($saleitems as $item)
                <?php $saleqty = $saleqty + $item->quantity; ?>
                <tr>
                    <td>{{ $item->product_code }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-right">{{ $item->selling_price }}</td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{ $item->quantity }} {{ $item->measuring_type }}</td>
                    <td class="text-right">{{ number_format($item->selling_price * $item->quantity, 2, '.', '') }}</td>

                </tr>
            @endforeach
        @endif

        <tr class="alert-info">
            <td></td>
            <td></td>
            <td class="text-right">Total: </td>
            <td class="text-right"><b>{{ $purchaseqty }}</b></td>
            <td></td>
            <td class="text-right"><b>{{ $saleqty }}</b></td>
            <td></td>

        </tr>

        <tr class="alert-info">
            <td></td>
            <td></td>
            <td class="text-right text-danger">Balance: </td>
            <td class="text-right text-danger"><b>{{ $purchaseqty - $saleqty }}</b></td>
            <td></td>
            <td class="text-right"></td>
            <td></td>

        </tr>

        </tbody>
    </table>
</div>

@stop