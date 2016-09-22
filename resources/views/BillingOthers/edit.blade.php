@extends('layouts.master')

@section('content')

    <h1>Editing "{{ $items->product_name }}"</h1>
    <p class="lead">Edit and save this ProductMaster below, or <a href="{{ route('ProductMaster.index') }}">go back to ProductMaster.</a></p>
    <hr>

    @include('partials.alerts.errors')
    <div class="row">

        {!! Form::model($items, [
            'method' => 'PATCH',
            'route' => ['ProductMaster.update', $items->id]
        ]) !!}

        <div class="col-md-3">
            {!! Form::input('text', 'product_name', null, array('id' => 'product_name', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'product_name', 'tabindex' => 2)) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'kg', null, array('id' => 'kg', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'kg', 'tabindex' => 3)) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'selling_price', null, array('id' => 'selling_price', 'class' => 'input-lg form-control TabOnEnter', 'placeholder' => 'selling_price', 'tabindex' => 4)) !!}
        </div>
        <div class="col-md-1">
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@stop