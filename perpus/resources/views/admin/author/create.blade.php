@extends('layouts.admin')
@section('header', 'Author')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Author</h3>
                    </div>
    
                    <form action="{{ url('authors') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Enter Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Phone Number" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required>
                            </div>
                        </div>
    
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <a href="{{ url('authors') }}"><- back to..</a>
            </div>
        </div>
    </div>
@endsection
