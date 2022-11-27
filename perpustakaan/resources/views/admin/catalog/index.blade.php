@extends('layouts.admin')
@section('header', 'Catalog')


@section('content')
    <div id="controller">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('catalogs/create') }}" class="btn btn-primary">Create New catalogs</a>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead class="table-dark" align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Total Books</th>
                                    <th>Created At</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($catalogs as $key => $c)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td align="center">{{ count($c->books) }}</td>
                                        <td align="center">{{ date('D, d M Y', strtotime($c->created_at)) }}</td>
                                        <td>
                                            <form href="{{ url('catalogs', ['id' => $c->id]) }}" method="post">
                                                <input class="btn btn-danger" type="submit" value="delete"
                                                    onclick="return confirm('Are you sure?')">
                                                @method('delete')
                                                @csrf
                                            </form>
                                            <a href="{{ url('catalogs/' . $c->id . '/edit') }}"
                                                class="btn btn-warning">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
