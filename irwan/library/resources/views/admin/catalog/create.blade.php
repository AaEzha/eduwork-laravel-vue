@extends('layouts.admin')
@section('header', 'Catalog')

@section('content')
	<div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create New Catalog</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('catalogs') }}" method="post">
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <labe>Name</label> 
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" required="">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
@endsection