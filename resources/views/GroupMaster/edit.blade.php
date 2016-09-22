@extends('layouts.master')

@section('content')

    <h1>Editing "{{ $items->group_name }}"</h1>
    <p class="lead">Edit and save this TaxMaster below, or <a href="{{ route('GroupMaster.index') }}">go back to TaxMaster.</a></p>
    <hr>

    @include('partials.alerts.errors')
    <div class="row">

        {!! Form::model($items, [
            'method' => 'PATCH',
            'route' => ['GroupMaster.update', $items->id]
        ]) !!}

        <div class="col-md-2">
            {!! Form::input('text', 'group_name', null, array('id' => 'group_name', 'class' => 'form-control TabOnEnter', 'autofocus' => 'true', 'placeholder' => 'group_name', 'tabindex' => 1)) !!}
        </div>

        <div class="col-md-3">
            {!! Form::input('text', 'tax_percentage', null, array('id' => 'tax_percentage', 'class' => 'form-control TabOnEnter', 'placeholder' => 'tax_percentage', 'tabindex' => 1)) !!}
        </div>

        <div class="col-md-1">
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@stop