@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-6 ">
      <!-- general form elements -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Add New Catalog</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ url('catalogs') }}">
        @csrf   
          <div class="card-body">
            <div class="form-group">
              <label>Name</label>
              <input type="name" class="form-control" name="name"  placeholder="Enter name" required>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <a href="{{ url('catalogs') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back</a>
            <button type="submit" class="btn btn-danger">Save</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
</div>

@endsection