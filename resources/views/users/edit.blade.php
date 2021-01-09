@extends('layout/main')
@section('title', 'Orders')

@section('content')
    <form method="POST" action="{{ route('users/update', $user->id) }}">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="w-50 m-auto">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $user->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
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
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="2" @if ($user->role == 2) selected @endif>
                                Staff
                            </option>
                            <option value="1" @if ($user->role == 1) selected @endif>
                                Admin
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Update</button>
                </div>
            </div>
        </div>
    </form>
    <div class="m-0 d-inline">
        <a href="{{ route('users/changePassword', $user->id) }}" class="pull-right small">
            <i class="fas fa-unlock-alt"></i>
            Change Password?
        </a>
    </div>
@endsection
