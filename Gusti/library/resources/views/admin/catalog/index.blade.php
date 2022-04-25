@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('catalogs/create') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i>
                            Add New Catalog</a>

                    </div>

                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 10px">No</th>
                                    <th>Name</th>
                                    <th>Total Books</th>
                                    <th>Create At</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($catalogs as $catalog)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $catalog->name }}</td>
                                        <td class="text-center">{{ count($catalog->books) }}</td>
                                        <td class="text-center">{{ dateFormat($catalog->created_at) }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('/catalogs/' . $catalog->id . '/edit') }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <i class="bi bi-pencil"></i></a> --}}

                                            <form action="{{ url('catalogs', ['id' => $catalog->id]) }}" method="POST" class="d-inline p-2">
                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    
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
