@extends('layouts.admin')

@section('header', 'Author')

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 ">
            <!-- general form elements -->
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">
                        Add New Author
                    </h3>

                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ url('authors') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="name" class="form-control" name="name" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="phone_number" class="form-control" name="phone_number"
                                placeholder="Enter phone number" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="address" class="form-control" name="address" placeholder="Enter address"
                                required>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ url('authors') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Back</a>

                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
