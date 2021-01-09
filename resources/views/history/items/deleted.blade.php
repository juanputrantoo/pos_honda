@extends('layout/main')
@section('title', 'Orders')

@section('content')
    <strong>Deleted Items</strong>
    <hr>
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
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                data-target="#modal-restore-item-{{ $itm->id }}">
                                <i class="fas fa-undo"></i>
                            </button>
                            <form method="POST" action="{{ route('history/items/deleted/restore', $itm->id) }}">
                                @csrf
                                <div class="modal fade" id="modal-restore-item-{{ $itm->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Restore Item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to restore <strong>{{ $itm->name }}</strong> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-info">Restore</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    </div>
@endsection
