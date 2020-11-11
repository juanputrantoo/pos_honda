@extends('layout/main')
@section('title', 'Items')

@section('content')
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Part Number</label>
            <input type="text" class="form-control" id="part_number" name="part_number" value="{{ $item->part_number }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
