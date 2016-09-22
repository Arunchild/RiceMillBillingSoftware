@extends('layouts.master')

@section('content')

    <h1>TaxMaster List</h1>
    <p class="lead">Here's a list of all your TaxMaster. <a href="{{ route('GroupMaster.create') }}"> Add a new one?</a></p>
    <hr>

    <div class="col-md-12">
        <table class="table table-bordered table-condensed table-hover table-responsive">
            <thead class="alert-warning">
                <th>Tax_name</th>
                <th>tax_percentage</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </thead>

            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->group_name }}</td>
                    <td>{{ $item->tax_percentage }}</td>
                    <td class="text-center"><a href="{{ route('GroupMaster.edit', $item->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                    <td class="text-center">
                        {!! Form::open([
                           'method' => 'DELETE',
                           'route' => ['GroupMaster.destroy', $item->id]
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