@extends('layout/main')
@section('title', 'Home')

@section('content')
<div class="text-center">

    <img class="img-sumur-bor" src="{{ asset('/asset/images/Honda Sumur Bor.jpg') }}">
    {{-- <h5 style="position: absolute;">SELAMAT DATANG, 
        <strong>{{ Auth::user()->name }}</strong>
    </h5> --}}
</div>
@endsection
