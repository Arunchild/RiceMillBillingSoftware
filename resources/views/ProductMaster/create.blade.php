@extends('layouts.master')

@section('content')
        <!-- AutoComplete for Company Names -->

<h3 class="text-center">ProductMaster - Create</h3>
    <hr>

    @include('partials.alerts.errors')
    {!! Form::open([
        'route' => 'ProductMaster.store', 'id' => 'formidda'
    ]) !!}

    <div class="col-md-3"> {!! Form::input('text', 'product_name', null, array('id' => 'product_name', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'product_name', 'autofocus', 'tabindex' => 2)) !!} </div>
    <div class="col-md-3"> {!! Form::input('text', 'kg', null, array('id' => 'kg', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'kg', 'tabindex' => 3)) !!} </div>
    <div class="col-md-3"> {!! Form::input('text', 'selling_price', null, array('id' => 'selling_price', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'selling_price', 'tabindex' => 4)) !!} </div>

    <div class="col-md-1">
        {!! Form::button('ADD', array('class' => 'btn-lg CreateCashEntry btn btn-primary TabOnEnter', 'tabindex' => 23)) !!}
    </div>

    <div class="col-md-12"> {!! Form::close() !!}

@stop