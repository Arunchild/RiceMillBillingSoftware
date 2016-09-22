@extends('layouts.master')

@section('content')

    <h1>BillList Kurunai</h1>
    <p class="lead">Here's a list of all your BillList. <a href="{{ route('BillingKurunai.create') }}"> Add a new one?</a></p>
    <hr>

    <div class="col-md-12">
        <table class="table table-bordered table-condensed table-hover table-responsive">
            <thead class="alert-warning">
            <th>Sale date</th>
            <th>Bill Number</th>
            <th class="text-right">Grand Total</th>
            <th class="text-right">Discount</th>
            <th class="text-right">Net Total</th>
            <th class="text-center">Show</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Cancel</th>
            </thead>

            <tbody>
            @foreach($items as $item)
                @if($item->trashed())
                    <tr class="">
                        <td><strike>{{ $item->sale_date->format('d-m-Y') }}</strike></td>
                        <td><strike>{{ $item->bill_number }}</td>
                        <td class="text-right"><strike>{{ $item->grand_total }}</td>
                        <td class="text-right"><strike>{{ $item->discount }}</td>
                        <td class="text-right"><strike>{{ number_format($item->grand_total - $item->discount, 2, '.', '') }}</td>
                        <!--<td class="text-center"><a href="{{ route('BillingFinalKurunai.show', $item->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>-->
                        <td colspan="3"class="text-center">CANCELLED BILL</td>

                    </tr>
                @else
                    <tr>
                        <td class="success">{{ $item->sale_date->format('d-m-Y') }}</td>
                        <td class="success">{{ $item->bill_number }}</td>
                        <td class="danger text-right">{{ $item->grand_total }}</td>
                        <td class="danger text-right">{{ $item->discount }}</td>
                        <td class="success text-right">{{ number_format($item->grand_total - $item->discount, 2, '.', '') }}</td>
                        <td class="text-center"><a href="{{ route('BillingFinalKurunai.show', $item->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                        <td class="text-center"><a href="{{ route('BillingFinalKurunai.edit', $item->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                        <td class="text-center">
                            {!! Form::open([
                               'method' => 'DELETE',
                               'route' => ['BillingFinalKurunai.destroy', $item->id]
                           ]) !!}

                            {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}

                            {!! Form::close() !!}
                        </td>

                    </tr>
                @endif
            @endforeach

            @foreach($totals as $total)
                <tr>
                    <td class=""></td>
                    <td class="text-right text-danger"><b>Total : </b></td>
                    <td class="text-right text-danger"><b>{{ $total->grand_total }}</b></td>
                    <td class="text-right text-danger"><b>{{ $total->discount }}</b></td>
                    <td class=" text-right text-danger"><b>{{ number_format($total->grand_total - $total->discount, 2, '.', '') }}</b></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <?php echo str_replace('/?', '?', $items->render()); ?>
    </div>

@stop