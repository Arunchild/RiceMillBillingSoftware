@extends('layouts.master')

@section('content')

    <h1>BillOthers List</h1>
    <p class="lead">Here's a list of all your BillOthersList. <a href="{{ route('BillingOthers.create') }}"> Add a new one?</a></p>
    <hr>

    <div class="col-md-12">
        <table class="table table-bordered table-condensed table-hover table-responsive">
            <thead class="alert-warning">
                <th>product_name</th>
                <th class="text-right">kg</th>
                <th class="text-right">selling_price</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </thead>

            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-right">{{ $item->kg }}</td>
                    <td class="text-right">{{ $item->selling_price }}</td>
                    <td class="text-center"><a href="{{ route('BillingOthers.edit', $item->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                    <td class="text-center">
                        {!! Form::open([
                           'method' => 'DELETE',
                           'route' => ['BillingOthers.destroy', $item->id]
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