@extends('layouts.master')

@section('content')

    <h1>Editing "{{ $items->bill_number }}"</h1>

    @include('partials.alerts.errors')

    <div class="row">
        <div class="col-md-3">SALES DATE</div>
        <div class="col-md-3">BILL NUMBER</div>
        <div class="col-md-3">GRAND TOTAL</div>
        <div class="col-md-3">DISCOUNT</div>
    </div>

    <div class="row">

        {!! Form::model($items, [
            'method' => 'PATCH',
            'route' => ['BillingFinal.update', $items->id]
        ]) !!}

        <div class="col-md-3">
            {!! Form::input('text', 'sale_date', $items->sale_date->format('d-m-Y'), array('id' => 'sale_date', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'sale_date', 'tabindex' => 2, 'readonly')) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'bill_number', null, array('id' => 'bill_number', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'bill_number', 'tabindex' => 3, 'readonly')) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'grand_total', null, array('id' => 'grand_total', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'grand_total', 'tabindex' => 4, 'readonly')) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'discount', null, array('id' => 'discount', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'discount', 'tabindex' => 5, 'autofocus')) !!}
        </div>

        <div class="col-md-1">
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@stop