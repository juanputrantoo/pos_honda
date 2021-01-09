@extends('layout/main')
@section('title', 'Orders')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show text-center w-75 m-auto" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <form method="POST" action="{{ route('users/updatePassword', $user->id) }}">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="w-50 m-auto">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                            name="current_password">
                        @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                            name="new_password">
                        @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control @error('confirm_new_password') is-invalid @enderror"
                            name="confirm_new_password">
                        @error('confirm_new_password')
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

@endsection
