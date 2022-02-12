@extends('layouts.admin')

@section('title','author')
@section('content')
    <div class="col-md-12">
        <div class="card">
        <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="card-title mt-3">authors </h4>
            <div>
                <a href="{{ route('authors.create') }}" class="btn  btn-primary">Add New author</a>
            </div>
            </div>
            <div class="table-responsive">
            <table class="table table-hover ">
                <thead>
                <tr>
                    <th width="10">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th >Total Books</th>
                    <th >Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $key => $author)
                    <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->email }}</td>
                    <td>{{ $author->phone_number }}</td>
                    <td>{{ $author->address }}</td>
                    <td >{{ count($author->books) }}</td>
                    <td>
                        <div class="d-flex justify-content-around">
                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="post">
                            <input type="submit" class="btn btn-sm btn-danger ms-2" value="Delete" onclick="return confirm('Are you sure?')">
                            @method('DELETE')
                            @csrf
                        </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
@endsection
