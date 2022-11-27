@extends('layouts.admin')
@section('header', 'Catalog Create')

@section('content')

    <div id="controller">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ url('catalogs/') }}" class="btn btn-dark">Back</a>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ url('catalogs') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="name.." required>
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
        </section>
    </div>
@endsection