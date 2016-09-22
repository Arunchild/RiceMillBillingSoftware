@extends('layouts.master')

@section('content')
        <!-- AutoComplete for Company Names -->

<h3 class="text-center">Showing <span class="text-danger">Bill Number Others{{ $finaldatas->bill_number }}</span>, Dated <span class="text-danger">{{ $finaldatas->sale_date->format('d-m-Y') }}</span></h3>
<p class="lead text-center">See All. <a href="{{ route('BillingFinalOthers.index') }}"> Go Back?</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'BillingOthers.store', 'id' => 'formidda'
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
               <!-- <td class="text-center hidden-print">
                    {!! Form::open([
                       'method' => 'DELETE',
                       'route' => ['BillingOthers.destroy', $item->id]
                   ]) !!}

                    {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}

                    {!! Form::close() !!}
                </td> -->

            </tr>
        @endforeach

        <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right">TOTAL:</td>
            <td class="text-right"><b>{{ $finaldatas->grand_total  }}</b></td>
        </tr>

        @if($finaldatas->discount > 0)
            <tr>
                <td></td>
                <td></td>
                <td colspan="2" class="text-right">DISCOUNT:</td>
                <td class="text-right"><b> (-) {{ $finaldatas->discount  }}</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="2" class="text-right">NET:</td>
                <td class="text-right"><b>{{ number_format($finaldatas->grand_total - $finaldatas->discount, 2, '.', '')  }}</b></td>
            </tr>
        @endif

        </tbody>
    </table>
</div>
<div class="clearfix"></div>
<div class="col-md-1 col-md-offset-11"><input value="{{ $finaldatas->id }}" class="hidden" id="bill_print_id"/> <button type="button" class="btn btn-danger" id="bill_print_others">Print</button></div>
@stop