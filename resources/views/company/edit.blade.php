@extends('layouts.master')

@section('content')
<div class="container">
    <p class="lead">Edit and Update this Company Details below, or <a href="{{ route('company.index') }}">Go back to all Company Details.</a></p>
    <hr>

    @include('partials.alerts.errors')


    {!! Form::model($items, [
        'method' => 'PATCH',
        'route' => ['company.update', $items->id]
    ]) !!}
    <div class="row">
        <div class="col-md-3">
            {!! Form::input('text', 'tin', null, array('class' => 'form-control TabOnEnter', 'autofocus' => 'true', 'tabindex' => 1, 'placeholder' => 'Tin')) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'cst', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'CST', 'tabindex' => 2)) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'companyname', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'Company Name', 'tabindex' => 4)) !!}
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3">
            {!! Form::input('text', 'billingname', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'Billing Name', 'tabindex' => 5)) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'phone', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'Phone Number', 'tabindex' => 6)) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'addressline1', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'Adress Line 1', 'tabindex' => 7)) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'addressline2', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'Address Line 2', 'tabindex' => 8)) !!}
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            {!! Form::input('text', 'terms_and_conditions', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'Terms and Conditions', 'tabindex' => 9)) !!}
        </div>
    </div>
    <div class="row">
        {!! Form::submit('Update cashentry', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>

@stop