@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Table Data Catalog</h3>
        </div>
        <div class="card-body">
            <a href="{{ url('catalogs/create') }}" class="btn btn-primary mb-3">Create New Catalog</a>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Total Books</td>
                        <td>Created At</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catalogs as $key => $c)    
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ count($c->books) }}</td>
                            <td>{{ date('d M Y', strtotime($c->created_at)) }}</td>
                            <td>
                                <a href="{{ url('catalogs/'.$c->id.'/edit') }}" class="btn btn-warning btn-sm">edit</a>
                                <form action="{{ url('catalogs', ['id' => $c->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input class="btn btn-danger btn-sm" type="submit" value="delete" onclick="return confirm('Are you sure?')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table><br>
            {{ $catalogs->links() }}
        </div>
    </div>
@endsection