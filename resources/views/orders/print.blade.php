<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style>
    .invoice-table {
        border-collapse: collapse;
        width: 100%;
        /* margin-top: 100px; */
        border-left: 1px solid black;
        border-right: 1px solid black;
    }

    .invoice-table tr th {
        border-bottom: 1px solid black;
        border-top: 1px solid black;
    }

    .invoice-table tr.total td {
        border-bottom: 1px solid black;
        border-top: 1px solid black;
    }

    .head{
        display: flex;
        height: 90px;
        font-size: 15px;
    }
    .table-right{
        width: 100%;
        text-align: right;
        margin-left: 450px;
    }

    

</style>

<body>
    {{-- <h2 style="text-align: right;">INVOICE</h2> --}}
    <div class="head">
        <table class="table-left">
            <tr>
                <td><strong>Invoice #</strong></td>
                <td>: {{ $order->order_number }}</td>
            </tr>
            <tr>
                <td><strong>Admin</strong></td>
                <td>: {{ $order->user->name }}</td>
            </tr>
            <tr>
                <td><strong>Date</strong></td>
                <td>: {{ date('d/m/Y', strtotime($order->created_at)) }}</td>
            </tr>
            <tr>
                <td><strong>Payment</strong></td>
                <td>: {{ $order->payment_method }}</td>
            </tr>
        </table>
        <table class="table-right">
            <tr>
                <td>{{ $company->name }}</td>
            </tr>
            <tr>
                <td>{{ $company->phone_number }}</td>
            </tr>
            <tr>
                <td>{{ $company->address }}</td>
            </tr>
        </table>

    </div>
    <hr>

    <table class="invoice-table">
        <tr>
            <th>Product</th>
            <th>Part Number</th>
            <th>Qty</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Disc%</th>
            <th align="right">Sub Total</th>
        </tr>
        @foreach ($order->items as $odr)
            <tr>
                <td align="center">{{ $odr->name }}</td>
                <td align="center">{{ $odr->part_number }}</td>
                <td align="center">{{ $odr->pivot->quantity }}</td>
                <td align="center">{{ $odr->pivot->unit }}</td>
                <td align="center">@currency($odr->price)</td>
                <td align="center">{{ $odr->pivot->discount }}</td>
                <td align="right">@currency($odr->pivot->sub_total)</td>
            </tr>
        @endforeach
        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total :</strong></td>
            <td align="right">@currency($order->total)</td>
        </tr>
    </table>
</body>

</html>
