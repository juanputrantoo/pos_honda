@extends('layout/main')
@section('title', 'Items')

@section('content')

    <div class="m-0 d-inline">
        <a href="{{ url('/items') }}" class="btn btn-info w-auto pull-left">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </a>
        <button type="submit" class="btn btn-danger pull-right" data-toggle="modal"
            data-target="#modal-delete-item-{{ $item->id }}">
            <i class="fa fa-trash"></i>
        </button>
    </div>
    <div class="modal fade" id="modal-delete-item-{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Item <i class="fas fa-trash text-danger"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure delete <strong>{{ $item->part_number }} ({{ $item->name }})</strong> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form method="POST" action="/items/{{ $item->id }}" class="m-0">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <form method="POST" action="/items/{{ $item->id }})">
        @method('patch')
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-titles">
                    <strong>
                        Edit Item
                    </strong>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Part Number</label>
                            <input type="text" class="form-control @error('part_number') is-invalid @enderror"
                                name="part_number" value="{{ $item->part_number }}">
                            @error('part_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $item->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" value="{{ $item->description }}">
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Stock</label>
                            <div class="d-flex">

                                <input type="number" class="form-control" value="{{ $item->stock }}" readonly>
                                <button type="button" class="btn btn-sm bg-transparent border-0 text-warning"
                                    data-toggle="modal" data-target="#modal-add-stock">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                    value="{{ $item->price }}">
                            </div>
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-warning w-50">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form method="POST" action="{{ route('items/stock', $item->id) }}">
        @method('patch')
        @csrf
        <div class="modal fade" id="modal-add-stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-0">
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock">
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
