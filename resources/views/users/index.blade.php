@extends('layout/main')
@section('title', 'Orders')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <a class="btn btn-primary" href="{{ route('users/create') }}">
                Create User
            </a>
        </div>
    </div>
    <hr>
    <table class="table w-75 m-auto text-center">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Last Login</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->username }}</td>
                    <td class="align-middle">
                        @if ($user->role == 1)
                            Admin
                        @elseif ($user->role == 2)
                            Staff
                        @endif
                    </td>
                    <td class="align-middle">
                        @if ($user->last_login == null)
                            -
                        @else
                            {{ $user->last_login->format('d/m/Y H:i') }}
                        @endif
                    </td>
                    <td class="align-middle">
                        @if (Auth::user()->id != $user->id)
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#modal-delete-user-{{ $user->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form method="POST" action="{{ route('users/destroy', $user->id) }}">
                                @method('delete')
                                @csrf
                                <div class="modal fade" id="modal-delete-user-{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure delete <strong>{{ $user->name }}</strong> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
