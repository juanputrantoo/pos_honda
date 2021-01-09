@extends('layout/main')
@section('title', 'Orders')

@section('content')
    <div class="m-0 d-inline">
        <a href="{{ route('history/orders/all') }}" class="btn btn-info w-auto pull-left">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </a>
    </div>
    <hr>
    
    <strong>Orders Between : </strong>
    <div>

        {{ date('d/m/Y', strtotime($new_from_date)) }}
        <i class="fas fa-arrow-right small"></i>
        {{ date('d/m/Y', strtotime($new_to_date)) }}
    </div>

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
                        <td class="align-middle">{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                        <td class="align-middle">
                            <a href="{{ route('history/orders/detail', $order->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@endsection
