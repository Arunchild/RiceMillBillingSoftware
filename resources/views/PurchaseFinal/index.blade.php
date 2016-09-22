@extends('layouts.master')

@section('content')

    <h1>Purchase</h1>
    <p class="lead">Here's a list of all your PurchaseList. <a href="{{ route('Purchase.create') }}"> Add a new one?</a></p>
    <hr>

    <div class="col-md-12">
        <table class="table table-bordered table-condensed table-hover table-responsive">
            <thead class="alert-warning">
            <th>Sale date</th>
            <th>Purchase Number</th>
            <th class="text-right">Total</th>
            <th class="text-center">Show</th>
           <!-- <th class="text-center">Edit</th>-->
            <th class="text-center">Delete</th>
            </thead>

            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->sale_date->format('d-m-Y') }}</td>
                    <td>{{ $item->purchase_number }}</td>
                    <td class="text-right">{{ $item->grand_total }}</td>
                    <td class="text-center"><a href="{{ route('PurchaseFinal.show', $item->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                    <!-- <td class="text-center"><a href="{{ route('PurchaseFinal.edit', $item->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>-->
                    <td class="text-center">
                        {!! Form::open([
                           'method' => 'DELETE',
                           'route' => ['PurchaseFinal.destroy', $item->id]
                       ]) !!}

                        {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}

                        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop