@extends('layout/main')
@section('title', 'Orders')

@section('content')

    <strong>All Orders</strong>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="d-inline">
                <form method="GET" action="{{ route('orders/dateRange') }}">
                    <div class="input-group date datepicker" id='datepicker_start' style="width: 200px;">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary">
                                <i class="fas fa-calendar fa-sm"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control small rounded-0 @error('from_date') is-invalid @enderror"
                            name="from_date" readonly>
                        </div>
                        <i class="fas fa-arrow-right m-auto"></i>


                    <div class="input-group date datepicker" id='datepicker_start' style="width: 200px;">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary">
                                <i class="fas fa-calendar fa-sm"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control small rounded-0 @error('to_date') is-invalid @enderror"
                            name="to_date" readonly>
                        </div>
                                <button type="submit" class="border-0 bg-transparent">
                                    <i class="fas fa-search text-primary"></i>
                                </button>

                </form>
            </div>
        </div>
        <div class="col-md-6 d-flex align-middle">
            <div class="input-group w-75 m-auto">
                <input type="text" id="search_orders" class="form-control bg-light border-1 small"
                    placeholder="Input order number here..." name="search_orders">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" disabled>
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </div>
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
                        <td class="align-middle">{{ date('d/m/Y', strtotime($order->updated_at)) }}</td>
                        <td class="align-middle">
                            <a href="{{ route('history/orders/all/detail', $order->id) }}" class="btn btn-primary btn-sm">
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
@push('scripts')
    <script>
        $(function() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                orientation: "bottom left"
            });
        });

        $('#search_orders').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{{ route("orders/search") }}',
                dataType: 'json',
                data: {
                    'search_orders': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        })

    </script>
@endpush
