@extends('layouts.admin')
@section('header', 'Publisher')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create New Publisher</h3>
    </div>

    <form method="POST" action="{{ url('publishers') }}">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required autofocus>
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <label for="address">address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection