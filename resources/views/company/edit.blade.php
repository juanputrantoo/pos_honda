@extends('layout/main')
@section('title', 'Items')

@section('content')

    {{-- {{ $company->name }} --}}

    <div class="m-0 d-inline">
        <a href="{{ route('company') }}" class="btn btn-info w-auto pull-left">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </a>
    </div>
    <hr>
    <form method="POST" action="{{ route('company/update', $company->id) }}" class="w-50 m-auto">
        @method('patch')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ $company->name }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number"
                value="{{ $company->phone_number }}">
            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{$company->address}}</textarea>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-warning w-100">
            Update
        </button>
    </form>

@endsection
