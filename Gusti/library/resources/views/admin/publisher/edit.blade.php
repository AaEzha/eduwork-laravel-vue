@extends('layouts.admin')

@section('header', 'Author')

@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-6 ">
      <!-- general form elements -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Edit Publisher</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ url('publishers/'.$publisher->id) }}">
        @csrf   
        {{ method_field ('PUT') }}
          <div class="card-body">

            <div class="form-group">
              <label>Name</label>
              <input type="name" class="form-control" name="name"  placeholder="Enter name" value="{{ $publisher->name }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email"  placeholder="Enter email" value="{{ $publisher->email }}" required>
              </div>
              <div class="form-group">
                <label>Phone number</label>
                <input type="phone_number" class="form-control" name="phone_number"  placeholder="Enter phone number" value="{{ $publisher->phone_number }}" required>
              </div>
              <div class="form-group">
                <label>Address</label>
                <input type="address" class="form-control" name="address"  placeholder="Enter address" value="{{ $publisher->address }}" required>
              </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
              <a href="{{ url('publishers') }}" class="btn btn-primary">
              <i class="bi bi-arrow-left"></i> Back</a>
            <button type="submit" class="btn btn-danger">Save</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
</div>


@endsection
