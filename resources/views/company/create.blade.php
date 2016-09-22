@extends('layouts.master')

@section('content')
<div class="container">
    <h3>Add a New Company</h3>
    <hr><p class="lead">Create New Company, or <a href="{{ route('company.index') }}">Go back to all Company Details.</a></p>

    @include('partials.alerts.errors')

    {!! Form::open([
        'route' => 'company.store', 'id' => 'formidda'
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
    <br/>
<div class="row">
    <div class="col-md-12 text-center">
        {!! Form::button('Create New Company', array('class' => 'CreateCashEntry btn btn-primary TabOnEnter', 'tabindex' => 10)) !!}
    </div>
</div>
    {!! Form::close() !!}
</div>
@stop