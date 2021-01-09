@extends('layout/main')
@section('title', 'Orders')

@section('content')
    <div class="m-0 d-inline">
        <a href="{{ url('/orders') }}" class="btn btn-info w-auto pull-left">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </a>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 m-auto">
            <table class="m-auto">
                <input type="hidden" id="order_id" value="{{ $order->id }}">
                <tr>
                    <td><strong>Invoice #</strong></td>
                    <td>: {{ $order->order_number }}</td>
                </tr>
                <tr>
                    <td><strong>Date</strong></td>
                    <td>: {{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Admin</strong></td>
                <td>: {{ $order->user->name }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close ml-2" data-dismiss="alert">x</button>
                    {{ session('error') }}
                </div>
            @endif
            <div class="border p-1">
                <form method="POST" action="{{ url('/itemorders') }}">
                    @csrf
                    <input name='order_id' value="{{ Crypt::encrypt($order->id) }}" type="hidden" />
                    <div class="form-group row m-0">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Product</label>
                        <div class="col-sm-9">
                            <select name="items"
                                class="form-control form-control-sm items selectpicker @error('items') is-invalid @enderror"
                                id="items" data-live-search="true" data-size="5">
                                <option value="" disabled selected>...</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->part_number }} | {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('items')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name='price' placeholder='0' class="form-control form-control-sm price"
                                    step="0.00" id="price" min="0" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Qty</label>
                        <div class="col-sm-9">
                            <input type="number" name='quantity'
                                class="form-control form-control-sm w-auto quantity @error('quantity') is-invalid @enderror"
                                step="0" min="0" />
                            @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Unit</label>
                        <div class="col-sm-9">
                            <select name="unit"
                                class="form-control form-control-sm w-auto unit @error('unit') is-invalid @enderror"
                                id="unit">
                                <option value="" disabled selected>...</option>
                                <option value="PC">PC</option>
                                <option value="SET">SET</option>
                                <option value="LTR">LTR</option>
                                <option value="GLN">GLN</option>
                            </select>
                            @error('unit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Disc%</label>
                        <div class="col-sm-9">
                            <input type="number" name='discount' class="form-control form-control-sm w-auto discount"
                                step="any" id="discount" min="0" value="0" />
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm w-50" id="add_item">
                            <i class="fas fa-plus"></i>
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr class="bg-secondary">
    <table class="table text-center" id="table_products_order">
        <tr>
            <th>Product</th>
            <th>Part Number</th>
            <th>Qty</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Disc%</th>
            <th class="text-right">Sub Total</th>
            <th></th>
        </tr>
        @if (count($order->items) == 0)
            <tr>
                <td colspan="7">
                    <span>There are no products yet...</span>
                </td>
            </tr>
        @endif
        @foreach ($order->items as $odr)
            <tr>
                <td class="align-middle">{{ $odr->name }}</td>
                <td class="align-middle">{{ $odr->part_number }}</td>
                <td class="align-middle">{{ $odr->pivot->quantity }}</td>
                <td class="align-middle">{{ $odr->pivot->unit }}</td>
                <td class="align-middle">@currency($odr->price)</td>
                <td class="align-middle">{{ $odr->pivot->discount }}</td>
                <td class="align-middle text-right sub_total" id="sub_total"> @currency($odr->pivot->sub_total) </td>
                <td class="align-middle">
                    <form method="POST" action="/itemorders/{{ $odr->pivot->id }}" class="m-0">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-sm bg-transparent text-danger">
                            <i class="fa fa-times"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="right-0">
        <div class="row" style="margin-top:20px">
            <div class="col-md-12">
                <form method="POST" action="/orders/{{ $order->id }}" id="form-update-order">
                    @method('patch')
                    @csrf
                    <table class="table table-bordered w-auto pull-right" id="tab_logic_total">
                        <tbody>
                            <tr>
                                <th class="text-center align-middle">Total</th>
                                <td class="text-center">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name='total' id="total"
                                            class="form-control form-control-sm @error('total') is-invalid @enderror"
                                            readonly />
                                        @error('total')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center align-middle">Payment<br>Method</th>
                                <td class="text-center align-middle">
                                    <select name="payment_method"
                                        class="form-control form-control-sm payment_method @error('payment_method') is-invalid @enderror"
                                        id="payment_method">
                                        <option value="" disabled selected>...</option>
                                        <option value="CASH">CASH</option>
                                        <option value="DEBIT">DEBIT</option>
                                        <option value="TRANSFER">TRANSFER</option>
                                    </select>
                                    @error('payment_method')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-primary w-100" id="btn-submit">Save</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('.row').delegate('.items', 'change', function() {
                var pr = $(this).parent().parent();
                var id = pr.find('.items option:selected').val();
                var temp = {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                }
                $.ajax({
                    type: 'GET',
                    url: "{{ route('items/getPrice') }}",
                    dataType: 'json',
                    data: temp,
                    success: function(data) {
                        $('.price').val(data);
                    }
                });

            });
        });

        $(window).on("load", function() {
            sub_total = null;
            $('.sub_total').each(function() {
                var text = $(this).text();
                var new_text = text.replace(/[^0-9]/g,'');
                var num = parseInt(new_text);
                sub_total += num;
            });
            var money_format = sub_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            // console.log(money_format);
            $('#total').val(money_format);
        });

    </script>

@endpush
