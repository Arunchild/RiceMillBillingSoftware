@extends('layouts.master')

@section('content')
<div class="container">
    <p class="lead">Edit and Update this S Details below, or <a href="{{ route('company.index') }}">Go back to all Company Details.</a></p>
    <hr>

    @include('partials.alerts.errors')


    {!! Form::model($items, [
        'method' => 'PATCH',
        'route' => ['Settings.update', $items->id]
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
        {!! Form::submit('Update cashentry', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>

@stop