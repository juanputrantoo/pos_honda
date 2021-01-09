@extends('layout/main')
@section('title', 'Orders')

@section('content')
    @if ($order == null)
        <div class="row">
            <div class="col-md-12 text-center">
                <span>There are no orders yet...</span>
            </div>
        </div>
        <form method="POST" action="{{ url('/orders') }}">
            @csrf
            <div class="card p-2 position-fixed float-right rounded-0 bg-light shadow"
                style="top:25%; right: 0%; z-index:1;">
                <div class="form-group w-auto ml-2 mr-2">
                    <label>Order Number</label>
                    <input type="text" class="form-control form-control-sm" id="order_number" name="order_number"
                        value="{{ $order_number }}" readonly>
                </div>
                <div class="form-group w-auto ml-2 mr-2">
                    <label>Date</label>
                    <input type="datetime" class="form-control form-control-sm" id="created_at" name="created_at"
                        value="{{ date('d/m/Y') }}" readonly>
                </div>
                <div class="form-group w-auto ml-2 mr-2 m-auto">
                    <button type="submit" class="btn btn-primary btn-sm">Create Order</button>
                </div>
            </div>
        </form>
    @else
        <div class="card mb-2 w-50 m-auto">
            <div class="card-body">
                <h6 class="card-title">No. Order: <strong>{{ $order->order_number }}</strong></h6>
                <h6 class="card-subtitle mb-2 text-muted"> Date:
                    <strong class="text-primary">{{ $order->created_at->format('d/m/Y') }}</strong>
                    <a class="badge badge-primary badge-pill float-right my-auto" href="/orders/{{ $order->id }}">Detail</a>
                </h6>
                <h6 class="card-subtitle text-muted">
                    Admin: 
                    <strong>{{ $order->user->name }}</strong>
                </h6>
            </div>
        </div>
    @endif
@endsection
