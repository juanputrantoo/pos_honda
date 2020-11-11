@extends('layout/main')
@section('title', 'Orders')

@section('content')

    <div class="m-0 d-inline">
        <a href="{{ url('/users') }}" class="btn btn-info w-auto pull-left">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </a>
        <button type="button" class="btn btn-danger pull-right" data-toggle="modal"
            data-target="#modal-delete-user-{{ $user->id }}">
            <i class="fa fa-key"></i>
        </button>
    </div>

@endsection
