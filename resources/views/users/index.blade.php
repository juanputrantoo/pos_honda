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
    <table class="table w-50 m-auto text-center">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                {{-- <th scope="col">Username</th> --}}
                <th scope="col">Role</th>
                <th scope="col">Last Login</th>
                {{-- <th scope="col"></th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                    <td class="align-middle">{{ $user->name }}</td>
                    {{-- <td class="align-middle">{{ $user->username }}</td> --}}
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
                    {{-- </td>
                    <td class="align-middle">
                    <a href="{{ route('users/edit', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pen"></i>
                        </a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
