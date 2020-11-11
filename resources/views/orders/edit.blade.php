@extends('layout/main')
@section('title', 'Orders')

@section('content')
    <form method="POST" action="/orders/{{ $order->id }}">
        @method('patch')
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label>No. Order</label>
                <input type="text" class="form-control" id="order_number" name="order_number" value="{{ $order->order_number }}"
                    readonly>
            </div>
            <div class="form-group col-md-6">
                <label>Tanggal</label>
                <input type="datetime" class="form-control" id="created_at" name="created_at" value="{{ date('d/m/Y', strtotime($order->created_at)) }}"
                    readonly>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <table class="table" id="tab_logic">
                    <thead>
                        <tr>
                            <th class="text-center"> # </th>
                            <th class="text-center"> Product </th>
                            <th class="text-center"> Qty </th>
                            <th class="text-center"> Unit </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> sub_total </th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        <tr id='addr0'>
                            <td>1</td>
                            <td>
                                <select name="items[]" class="form-control items" id="items">
                                    <option value="" disabled selected>--- pilih barang ---</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name='quantity[]' placeholder='Enter quantity' class="form-control qty"
                                    step="0" min="0" />
                            </td>
                            <td>
                                <select name="unit[]" class="form-control unit" id="unit">
                                    <option value="PC" selected>PC</option>
                                    <option value="SET">SET</option>
                                    <option value="LTR">LTR</option>
                                    <option value="GLN">GLN</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" name='price[]' placeholder='0' class="form-control price" step="0.00"
                                    id="price" min="0" readonly />
                            </td>
                            <td>
                                <input type="number" name='sub_total[]' placeholder='0.00' class="form-control sub_total"
                                    readonly />
                            </td>
                        </tr>
                        <tr id='addr1'></tr>
                    </tbody> --}}
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="button" id="add_row" class="btn btn-success pull-left">Add Row</button>
                <button type="button" id='delete_row' class="pull-right btn btn-danger">Delete Row</button>
            </div>
        </div>
        <div class="right-0">
            <div class="row" style="margin-top:20px">
                <div class="pull-right col-md-4">
                    <table class="table table-bordered table-hover" id="tab_logic_total">
                        <tbody>
                            {{-- <tr>
                                <th class="text-center">Sub sub_total</th>
                                <td class="text-center"><input type="number" name='sub_total' placeholder='0.00'
                                        class="form-control" id="sub_total" readonly /></td>
                            </tr> --}}
                            <tr>
                                <th class="text-center">Tax</th>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="number" class="form-control" id="tax" placeholder="0">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center">Tax Amount</th>
                                <td class="text-center"><input type="number" name='tax_amount' id="tax_amount"
                                        placeholder='0.00' class="form-control" readonly /></td>
                            </tr>
                            <tr>
                                <th class="text-center">Grand sub_total</th>
                                <td class="text-center"><input type="number" name='total' id="total" placeholder='0.00'
                                        class="form-control" readonly /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Save">
    </form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('tbody').delegate('.items', 'change', function() {
                var tr = $(this).parent().parent();
                tr.find('.qty').focus();
                tr.find('.qty').val(0);
            })

            $('tbody').delegate('.qty', 'change', function() {
                var tr = $(this).parent().parent();
                tr.find('.sub_total').focus();
            })

            $('tbody').delegate('.items', 'change', function() {
                var tr = $(this).parent().parent();
                var id = tr.find('.items').val();
                var dataId = {
                    'id': id
                };
                $.ajax({
                    type: 'GET',
                    url: "/getprice",
                    dataType: 'json',
                    data: dataId,
                    success: function(data) {
                        // console.log($('#addr0:nth-child(3)').val(data));
                        // $('#price').val(data);
                        // $('input[name="price[]"]').val(data);
                        tr.find('.price').val(data);
                    }
                });
            });

            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change', function() {
                calc();
            });
            $('#tax').on('keyup change', function() {
                calc_total();
            });


        });

        function calc() {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if (html != '') {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.sub_total').val(qty * price);

                    calc_total();
                }
            });
        }

        function calc_total() {
            sub_total = 0;
            $('.sub_total').each(function() {
                sub_total += parseInt($(this).val());
            });
            $('#sub_total').val(sub_total.toFixed(2));
            tax_sum = sub_total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total').val((tax_sum + sub_total).toFixed(2));
        }

    </script>
@endpush
