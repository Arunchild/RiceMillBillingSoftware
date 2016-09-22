@extends('layouts.master')

@section('content')
<div class="container">
    <h3>Add a New settings</h3>
    <hr><p class="lead">Create New settings, or <a href="{{ route('Settings.index') }}">Go back to settings Details.</a></p>

    @include('partials.alerts.errors')

    {!! Form::open([
        'route' => 'Settings.store', 'id' => 'formidda'
    ]) !!}

<div class="row">
    <div class="col-md-3">
        {!! Form::input('text', 'printer_name', null, array('class' => 'form-control TabOnEnter', 'autofocus' => 'true', 'tabindex' => 1, 'placeholder' => 'printer_name')) !!}
    </div>

    <div class="col-md-3">
        {!! Form::input('text', 'copy', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'copy', 'tabindex' => 2)) !!}
    </div>

    <div class="col-md-3">
        {!! Form::input('text', 'preprint_space', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'preprint_space', 'tabindex' => 4)) !!}
    </div>
    <div class="col-md-3">
        {!! Form::input('text', 'bill_paper', null, array('class' => 'form-control TabOnEnter', 'placeholder' => 'bill_paper', 'tabindex' => 5)) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        {!! Form::button('Create Settings', array('class' => 'CreateCashEntry btn btn-primary TabOnEnter', 'tabindex' => 10)) !!}
    </div>
</div>
    {!! Form::close() !!}
</div>
@stop