@extends('layout/main')
@section('title', 'Items')

@section('content')

    <div class="m-0 d-inline">
        <a href="{{ url('/items') }}" class="btn btn-info w-auto pull-left">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </a>
    </div>
    <hr>
    <form method="POST" action="{{ url('/items') }}">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-titles">
                    <strong>
                        Create Item
                    </strong>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Part Number</label>
                            <input type="text" class="form-control part_number @error('part_number') is-invalid @enderror"
                                name="part_number" value="{{ old('part_number') }}">
                            @error('part_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" value="{{ old('description') }}">
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
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock"
                                value="{{ old('stock') }}">
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                                    value="{{ old('price') }}" id="price">
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
                        <button type="submit" class="btn btn-success w-50">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@push('scripts')
    <script>
        $('#price').mask('#.##0', {
            reverse: true
        });
    </script>
@endpush
