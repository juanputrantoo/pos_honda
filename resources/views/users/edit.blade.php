@extends('layout/main')
@section('title', 'Orders')

@section('content')

    <div class="m-0 d-inline">
        <a href="{{ url('/users') }}" class="btn btn-info w-auto pull-left">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </a>
        <button type="submit" class="btn btn-danger pull-right" data-toggle="modal" data-target="#modal-delete-user-{{ $user->id }}">
            <i class="fa fa-trash"></i>
        </button>
        <div class="modal fade" id="modal-delete-user-{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete User <i class="fas fa-trash text-danger"></i>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure delete <strong>{{ $user->name }}</strong> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form method="POST" action="{{ route('users/destroy', $user->id) }}" class="m-0">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
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
        <a href="" class="pull-right small">Change Password?</a>
    </div>
@endsection
