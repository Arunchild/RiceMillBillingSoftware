@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
    <h1 class="text-center text-danger">Settings</h1>

    <br/><h1 class="text-center text-warning">To create new settings <a class="btn btn-danger" href="{{ route('Settings.create') }}">click</a></h1><br/>

</div>
    <?php $i = 1; ?>
@foreach($items as $item)
    <div class="row">
        <div class="col-md-10 col-md-offset-1">


<div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Here's a Details of Settings {{ $i }} &#160;&#160;&#160;&#160;

                       <a href="{{ route('Settings.edit', $item->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        {!! Form::open([ 'method' => 'DELETE', 'style' => 'display:inline', 'class' => 'form-inline', 'route' => ['Settings.destroy', $item->id] ]) !!}
                        {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-condensed table-bordered">
                <tbody>
                <tr>
                    <td>Printer Name:</td>
                    <td>{{ $item->printer_name }}</td>
                </tr>
                <tr>
                    <td>Copy</td>
                    <td>{{ $item->copy }}</td>
                </tr>
                <tr>
                    <td>Preprint Space</td>
                    <td>{{ $item->preprint_space }}</td>
                </tr>
                <tr>
                    <td>Bill Paper:</td>
                    <td>{{ $item->bill_paper }}</td>
                </tr>
                </tbody>
            </table>


        </div>
</div>
        </div>
    </div>
    <?php $i++; ?>
        @endforeach
</div>
@stop