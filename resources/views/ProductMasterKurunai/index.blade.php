@extends('layouts.master')

@section('content')

    <h1>ProductMaster Kurunai List</h1>
    <p class="lead">Here's a list of all your ProductMaster Kurunai. <a href="{{ route('ProductMasterKurunai.create') }}"> Add a new one?</a></p>
    <hr>

    <div class="col-md-12">
        <table class="table table-bordered table-condensed table-hover table-responsive">
            <thead class="alert-warning">
                <th>product_code</th>
                <th>product_name</th>
                <th>kg</th>
                <th class="text-right">selling_price</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </thead>

            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->kg }}</td>
                    <td class="text-right">{{ $item->selling_price }}</td>
                    <td class="text-center"><a href="{{ route('ProductMasterKurunai.edit', $item->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                    <td class="text-center">
                        {!! Form::open([
                           'method' => 'DELETE',
                           'route' => ['ProductMasterKurunai.destroy', $item->id]
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