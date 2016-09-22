@extends('layouts.master')

@section('content')
        <!-- AutoComplete for Company Names -->

<h3 class="text-center">Showing Purchase Number {{ $finaldatas->purchase_number }}, Dated {{ $finaldatas->sale_date->format('d-m-Y') }}</h3>
<p class="lead text-center">See All. <a href="{{ route('PurchaseFinalKurunai.index') }}"> Go Back?</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'PurchaseKurunai.store', 'id' => 'formidda'
]) !!}

<div class="clearfix"></div>
<!-- Product display area-->

<div class="col-md-12">
    <table class="table table-bordered table-condensed table-hover table-responsive">
        <thead class="alert-warning">
        <th>Code</th>
        <th>Item Name</th>
        <th class="text-right">Price</th>
        <th class="text-right">Quantity</th>
        <th class="text-right">Total</th>
        <th class="text-center">Edit</th>
        <!--  <th class="text-center hidden-print">Delete</th> -->
        </thead>

        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->product_code }}</td>
                <td>{{ $item->product_name }}</td>
                <td class="text-right">{{ $item->selling_price }} {{ $item->measuring_type }}</td>
                <td class="text-right">{{ $item->quantity }}</td>
                <td class="text-right">{{ number_format($item->selling_price * $item->quantity, 2, '.', '') }}</td>
                <td class="text-center"><a href="{{ route('PurchaseKurunai.edit', $item->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
               <!-- <td class="text-center hidden-print">
                    {!! Form::open([
                       'method' => 'DELETE',
                       'route' => ['PurchaseKurunai.destroy', $item->id]
                   ]) !!}

                    {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}

                    {!! Form::close() !!}
                </td>-->

            </tr>
        @endforeach

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>NET:</td>
            <td class="text-right"><b>{{ $finaldatas->grand_total  }}</b></td>
        </tr>

        </tbody>
    </table>
</div>

@stop