@extends('layout/main')
@section('title', 'Items')

@section('content')
    <div class="input-group w-50 m-auto">
        <input type="text" id="search_items"
            class="form-control bg-light border-1 small"
            placeholder="Input part number or name here..." name="search_items">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" disabled>
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>

    <div class="table-responsive-lg mt-4">
        <table class="table table-bordered table-hover">
            <thead>
                <tr align="center">
                    <th>No.</th>
                    <th>Part Number</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $itm)
                    <tr align="center">
                        <th class="align-middle">{{ $loop->iteration }}</th>
                        <td class="align-middle">{{ $itm->part_number }}</td>
                        <td class="align-middle">{{ $itm->name }}</td>
                        <td class="align-middle">{{ $itm->description }}</td>
                        <td class="align-middle">{{ $itm->stock }}</td>
                        <td class="align-middle">@currency($itm->price)</td>
                        <td class="pr-0 pl-0">
                            <a class="btn btn-warning btn-sm" href="/items/{{ $itm->id }}/edit"><i
                                    class="fa fa-pen-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a class="btn btn-success rounded-circle fab-add-button" href="{{ url('/items/create') }}">
        <i class="fas fa-plus align-middle"></i>
    </a>
@endsection

@push('scripts')
    <script>
        $('#search_items').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{{ route("items/search") }}',
                dataType: 'json',
                data: {
                    'search_items': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        })

    </script>
@endpush
