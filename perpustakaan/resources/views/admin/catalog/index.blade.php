@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')
    ini adalah halaman Catalog

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Table Data Catalog</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Total Books</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catalogs as $key => $c)    
                        <tr>
                            <th>{{ $key+1 }}</th>
                            <th>{{ $c->name }}</th>
                            <th>{{ count($c->books) }}</th>
                            <th>{{ date('d M Y', strtotime($c->created_at)) }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table><br>
            {{ $catalogs->links() }}
        </div>
    </div>
@endsection