@extends('layouts.admin')
@section('header', 'Catalog create')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card card-primary">
                    <div class="card-header">
                        <a href="{{ url('catalogs') }}" class="btn btn-dark">Back</a>
                    </div>

                    <form action="{{ url('catalogs') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
