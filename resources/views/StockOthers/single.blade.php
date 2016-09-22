@foreach($purchaseditems as $purchased)
    <tr class="alert-info">
        <td>{{ $purchased->id }}</td>
        <td>{{ $purchased->product_name }}</td>
        <td>{{ $purchased->price }}</td>
        <td>{{ $purchased->quantity }}</td>
        <td>{{ $purchased->total }}</td>
    </tr>
@endforeach



<tr class="alert-info">
    <td></td>
    <td></td>
    <td></td>
    <td class="text-right text-danger">Balance: </td>
    <td class="text-right text-danger"><b></b></td>
    <td></td>
    <td class="text-right"></td>
    <td></td>
    <td></td>

</tr>