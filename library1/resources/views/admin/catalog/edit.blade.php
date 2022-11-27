@extends('layouts.admin')
@section('header', 'Catalog edit')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card card-primary">
                    <div class="card-header">
                        <a href="{{ url('catalogs') }}" class="btn btn-dark">cancel</a>
                    </div>

                    <form action="{{ url('catalogs/'.$catalog->id) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required value="{{ $catalog->name }}">
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
