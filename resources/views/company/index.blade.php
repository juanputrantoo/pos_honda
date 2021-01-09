@extends('layout/main')
@section('title', 'Items')

@section('content')

    <table class="w-50 m-auto">
        <tbody class="m-auto">
            <tr>
                <td>Name</td>
                <td>: {{ $comp->name }}</td>
            </tr>
    
            <tr>
                <td>Phone Number</td>
                <td>: {{ $comp->phone_number }}</td>
                <td>
                    <a href="{{ route('company/edit', $comp->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>: {{ $comp->address }}</td>
            </tr>
        </tbody>
    </table>
@endsection