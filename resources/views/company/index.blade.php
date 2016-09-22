@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
    <h1 class="text-center text-danger">Company Details</h1>

     <br/><h1 class="text-center text-warning">Want to create new one... <a class="btn btn-danger" href="{{ route('company.create') }}">Create Company</a></h1><br/>

</div>
    <?php $i = 1; ?>
@foreach($items as $item)
    <div class="row">
        <div class="col-md-10 col-md-offset-1">


<div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Here's a Details of Your Company {{ $i }} &#160;&#160;&#160;&#160;

                       <a href="{{ route('company.edit', $item->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        {!! Form::open([ 'method' => 'DELETE', 'style' => 'display:inline', 'class' => 'form-inline', 'route' => ['company.destroy', $item->id] ]) !!}
                        {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-condensed table-bordered">
                <tbody>
                <tr>
                    <td> Comapny Name:</td>
                    <td>{{ $item->companyname }}</td>
                </tr>
                <tr>
                    <td>TIN</td>
                    <td>{{ $item->tin }}</td>
                </tr>
                <tr>
                    <td>CST</td>
                    <td>{{ $item->cst }}</td>
                </tr>
                <tr>
                    <td> Billing Name:</td>
                    <td>{{ $item->billingname }}</td>
                </tr>
                <tr>
                    <td> Phone:</td>
                    <td>{{ $item->phone }}</td>
                </tr>
                <tr>
                    <td> Address 1:</td>
                    <td>{{ $item->addressline1 }}</td>
                </tr>
                <tr>
                    <td>Address 2: </td>
                    <td> {{ $item->addressline2 }}</td>
                </tr>
                <tr>
                    <td>Terms and conditions</td>
                    <td colspan="2">{{ $item->terms_and_conditions }}</td>
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