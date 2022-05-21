@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create New Catalog</h3>
        </div>
    
        <form method="POST" action="{{ url('catalogs') }}">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection