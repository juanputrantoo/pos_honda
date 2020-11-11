@extends('layout/main')
@section('title', 'Orders')

@section('content')
    <strong>Orders Between </strong>
    <hr>
    <div class="table-responsive-lg mt-4">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order Number</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th class="align-middle">{{ $loop->iteration }}</th>
                        <td class="align-middle">{{ $order->order_number }}</td>
                        <td class="align-middle">@currency($order->total)</td>
                        <td class="align-middle">{{ $order->payment_method }}</td>
                        <td class="align-middle">{{ date('d/m/Y', strtotime($order->updated_at)) }}</td>
                        <td class="align-middle">
                            <a href="{{ route('orders/print', $order->id) }}" class="btn btn-primary btn-sm"
                                target="_blank">
                                <i class="fas fa-print"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@endsection
