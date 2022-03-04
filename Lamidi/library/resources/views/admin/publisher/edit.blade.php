@extends('layouts.admin')
@section('header','Publisher')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Publisher</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url('publishers/'.$publisher ->id)}}" method="POST">
                @csrf
                {{method_field('PUT')}}
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required="" value="{{$publisher->name}}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" required="" value="{{$publisher->email}}">
                    </div>
                    <div class="form-group">
                        <label>phone Number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Enter Phone Number" required="" value="{{$publisher->phone_number}}">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address" required="" value="{{$publisher->address}}">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection