@extends('layout/main')
@section('title', 'Orders')

@section('content')


    <div class="m-0 d-inline">
        <a href="{{ route('history/orders/all') }}" class="btn btn-info w-auto pull-left">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </a>
        <a href="{{ route('orders/print', $order->id) }}" class="btn btn-primary pull-right" target="_blank">
            <i class="fas fa-print"></i>
        </a>
    </div>
    <hr>
    

    <div class="d-inline m-3">
        <div class="pull-left ml-5">
            <table>
                <tr>
                    <td>
                        <strong>Invoice #</strong>
                    </td>
                    <td>
                        : {{ $order->order_number }}
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Admin</strong>
                    </td>
                    <td>
                        : {{ $order->user->name }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="pull-right mr-5">
            <table>
                <tr>
                    <td>
                        <strong>Date</strong>
                    </td>
                    <td>
                        : {{ $order->created_at->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Payment</strong>
                    </td>
                    <td>
                        : {{ $order->payment_method }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <table class="invoice-table table">
        <tr>
            <th class="text-center">Product</th>
            <th class="text-center">Part Number</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Unit</th>
            <th class="text-center">Price</th>
            <th class="text-center">Disc%</th>
            <th class="text-right">Sub Total</th>
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

@endsection
