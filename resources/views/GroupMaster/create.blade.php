@extends('layouts.master')

@section('content')
    <h3 class="text-center">TaxMaster - Create</h3>
    <hr>

    @include('partials.alerts.errors')

    {!! Form::open([
        'route' => 'GroupMaster.store', 'id' => 'formidda'
    ]) !!}


    <div class="col-md-2"> {!! Form::input('text', 'group_name', null, array('id' => 'group_name', 'class' => 'input-lg form-control TabOnEnter', 'autofocus' => 'true', 'placeholder' => 'tax name', 'tabindex' => 1)) !!} </div>
    <div class="col-md-3"> {!! Form::input('text', 'tax_percentage', null, array('id' => 'tax_percentage', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'tax_percentage', 'tabindex' => 2)) !!} </div>

    <div class="col-md-1">
        {!! Form::button('ADD', array('class' => 'btn-lg CreateCashEntry btn btn-primary TabOnEnter', 'tabindex' => 23)) !!}
    </div>

    <div class="col-md-12"> {!! Form::close() !!}

@stop