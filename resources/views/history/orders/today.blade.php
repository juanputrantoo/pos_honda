@extends('layout/main')
@section('title', 'Orders')

@section('content')

    <div class="d-flex">
        <div>
            <strong>Today Orders</strong>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right border p-2 shadow">
                <table>
                    <tr>
                        <td>Orders</td>
                        <td>
                            <strong>: {{ count($orders) }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>Income</td>
                        <td>
                            <strong>: @currency($temp_total)</strong>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

    {{-- <div class="input-group w-50 m-auto">
        <input type="text" id="search_items" class="form-control bg-light border-1 small"
            placeholder="Input part number or name here..." name="search_items">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" disabled>
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div> --}}

    <div class="table-responsive-lg mt-4">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Order Number</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Admin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (count($orders) == 0)
                    <tr>
                        <td colspan="6">
                            There are no orders today yet...
                        </td>
                    </tr>
                @endif
                @foreach ($orders as $order)
                    <tr>
                        <th class="align-middle">{{ $loop->iteration }}</th>
                        <td class="align-middle">{{ $order->order_number }}</td>
                        <td class="align-middle">{{ date('d/m/Y', strtotime($order->updated_at ))}}</td>
                        <td class="align-middle">@currency($order->total)</td>
                        <td class="align-middle">{{ $order->user->name }}</td>
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
