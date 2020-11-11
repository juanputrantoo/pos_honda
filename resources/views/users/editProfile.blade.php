@extends('layout/main')
@section('title', 'Orders')

@section('content')

    <div class="m-0 d-inline">
        <a href="{{ url('/users') }}" class="btn btn-info w-auto pull-left">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </a>
    </div>
    <hr>
    <form method="POST" action="{{ route('users/updateProfile', $user->id) }}">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="w-50 m-auto">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                            value="{{ $user->username }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Update</button>
                </div>
            </div>
        </div>
    </form>
    <div class="m-0 d-inline">
        <a href="" class="pull-right small">Change Password?</a>
    </div>

@endsection
