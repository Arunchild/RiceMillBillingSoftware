@extends('layouts.master')

@section('content')
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
                    .append( "<a>" + item.label +" -"+ item.kg +"kg - Rs." + item.selling_price + "</a>" )
                    .appendTo( ul );
        };

        $(document).on("focus", "#selling_price", function(){
            $("#selling_price").select();
        });

    });
</script>

<h3 class="text-center">Purchase Kurunai - Add</h3>
    <hr>

    @include('partials.alerts.errors')

    {!! Form::open([
        'route' => 'PurchaseKurunai.store', 'id' => 'PurchaseItemForm'
    ]) !!}


<div class="col-md-2">{!! Form::input('text', 'sale_date', date('d-m-Y'), array('id' => 'sale_date', 'class' => 'datepicker form-control TabOnEnter', 'placeholder' => 'purchase_date')) !!}</div>

<div class="col-md-2">
    <div class="input-group">
        <span class="input-group-addon">Purchase No </span>
        {!! Form::input('text', 'purchase_number', $purchase_number, array('id' => 'purchase_number', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'purchase_number', 'readonly')) !!}
    </div>
</div>

    <div class="col-md-2 hidden-print">
        <div class="input-group">
            <span class="input-group-addon">Code</span>
            {!! Form::input('text', 'product_code', null, array('id' => 'product_code', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'product_code')) !!}
        </div>
    </div>
    <div class="col-md-3 hidden-print">
        <div class="input-group">
            <span class="input-group-addon">Name</span>
            {!! Form::input('text', 'product_name', null, array('id' => 'product_name', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'product_name', 'autofocus' => 'true')) !!}
         </div>
    </div>
<div class="col-md-2 hidden-print">
    <div class="input-group">
        <span class="input-group-addon">KG</span>
        {!! Form::input('text', 'kg', null, array('id' => 'kg', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'kg')) !!}
    </div>
</div>
    <div class="col-md-2 hidden-print">
        <div class="input-group">
            <span class="input-group-addon">Rs</span>
            {!! Form::input('text', 'selling_price', null, array('id' => 'selling_price', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'price')) !!}
        </div>
    </div>

    <div class="col-md-2 hidden-print">
        <div class="input-group">
            {!! Form::input('text', 'quantity', null, array('id' => 'quantity', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'quantity', 'tabindex' => 3)) !!}
            <span class="measuring_type input-group-addon"></span>
        </div>
    </div>

    <div class="col-md-1 hidden-print">
        {!! Form::button('ADD', array('class' => 'btn-lg PurchaseItem btn btn-primary TabOnEnter', 'tabindex' => 4)) !!}
    </div>

    {!! Form::close() !!}

            <div class="clearfix"></div>
    <!-- Product display area-->

        <div class="col-md-12">
            <table class="table table-bordered table-condensed table-hover table-responsive">
                <thead class="alert-warning">
                <th>Code</th>
                <th>Item Name</th>
                <th class="text-right">Price</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Total</th>
                <th class="text-center hidden-print">Delete</th>
                </thead>

                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->product_code }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td class="text-right">{{ $item->selling_price }}</td>
                        <td class="text-right">{{ $item->quantity }} {{ $item->measuring_type }}</td>
                        <td class="text-right">{{ number_format($item->selling_price * $item->quantity, 2, '.', '') }}</td>
                        <td class="text-center hidden-print">
                            {!! Form::open([
                               'method' => 'DELETE',
                               'route' => ['PurchaseKurunai.destroy', $item->id]
                           ]) !!}

                            {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}

                            {!! Form::close() !!}
                        </td>

                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>NET:</td>
                    <td class="text-right"><b>{{ $sum }}</b></td>
                    <td class="hidden-print"></td>
                </tr>

                </tbody>
            </table>
        </div>


{!! Form::open([
    'route' => 'PurchaseFinalKurunai.store', 'id' => 'PurchaseFinalForm'
]) !!}


<div class="col-md-2 hidden">
    <div class="input-group">
        <span class="input-group-addon">Purchase No </span>
        {!! Form::input('text', 'purchase_number', $purchase_number, array('id' => 'purchase_number', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'purchase_number', 'readonly')) !!}
    </div>
</div>

<div class="col-md-2 hidden">
    <div class="input-group">
        <span class="input-group-addon">grand_total </span>
        {!! Form::input('text', 'grand_total', $sum, array('id' => 'grand_total', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'grand_total', 'readonly')) !!}
    </div>
</div>

<div class="col-md-2 hidden">{!! Form::input('text', 'sale_date', date('d-m-Y'), array('id' => 'sale_date', 'class' => 'datepicker form-control TabOnEnter', 'placeholder' => 'purchase_date')) !!}</div>

<div class="col-md-1 col-md-offset-10">
    {!! Form::button('Finish', array('class' => 'btn-lg purchasefinalformclass btn btn-primary hidden-print')) !!}
</div>

{!! Form::close() !!}

@stop