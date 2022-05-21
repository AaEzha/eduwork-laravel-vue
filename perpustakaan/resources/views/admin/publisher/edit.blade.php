@extends('layouts.admin')
@section('header', 'Publisher')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Publisher</h3>
    </div>

    <form method="POST" action="{{ url('publishers/'.$publisher->id) }}">
        @csrf
        {{-- khusus untuk metod update put --}}
        {{ method_field('PUT') }}

        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required value="{{ $publisher->name }}">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required value="{{ $publisher->email }}">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" required value="{{ $publisher->phone_number }}">
            </div>
            <div class="form-group">
                <label for="address">address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required value="{{ $publisher->address }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection