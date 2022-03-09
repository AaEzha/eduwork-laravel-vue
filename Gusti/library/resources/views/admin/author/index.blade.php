@extends('layouts.admin')

{{-- @include('admin.includes.sidebar') --}}

@section('header', 'Author')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('authors/create') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i>
                            Add New Author</a>

                    </div>

                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 10px">No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($authors as $author)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $author->name }}</td>
                                        <td>{{ $author->email }}</td>
                                        <td>{{ $author->phone_number }}</td>
                                        <td>{{ $author->address }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/authors/' . $author->id . '/edit') }}"
                                                class="btn btn-sm btn-primary">Edit
                                                {{-- <i class="bi bi-pencil"></i> --}}
                                            </a>
                                            {{-- <i class="bi bi-pencil"></i></a> --}}

                                            <form action="{{ url('authors', ['id' => $author->id]) }}" method="POST"
                                                class="d-inline p-2">
                                                <input type="submit" value="Delete" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">

                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer clearfix px-2">
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection
