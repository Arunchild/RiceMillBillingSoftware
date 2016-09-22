@extends('layouts.master')

@section('content')
        <!-- AutoComplete for Company Names -->
            <script>
                $(function() {
                            @if(isset($groups))
                    var groups = {!! $groups !!};
                            @else
                    var groups = ["error"];
                    @endif

                    $( "#group_name" ).autocomplete({
                        autoFocus: true,
                        source: groups,
                        minLength: 0,
                        select: function(event, ui) {
                            $('#group_name').val(ui.item.value);
                        }
                    }).focus(function(){
                        $(this).autocomplete("search", "");
                    });
                });
            </script>


    <h1>Editing "{{ $items->product_name }}"</h1>
    <p class="lead">Edit and save this ProductMaster below, or <a href="{{ route('ProductMaster.index') }}">go back to ProductMaster.</a></p>
    <hr>

    @include('partials.alerts.errors')
    <div class="row">

        {!! Form::model($items, [
            'method' => 'PATCH',
            'route' => ['Purchase.update', $items->id]
        ]) !!}

        <div class="col-md-2">{!! Form::input('text', 'sale_date', date('d-m-Y'), array('id' => 'sale_date', 'class' => 'datepicker form-control TabOnEnter', 'placeholder' => 'purchase_date')) !!}</div>

        <div class="col-md-2">
            <div class="input-group">
                <span class="input-group-addon">Purchase No </span>
                {!! Form::input('text', 'purchase_number', null, array('id' => 'purchase_number', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'purchase_number', 'readonly')) !!}
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
        <div class="col-md-1">
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@stop