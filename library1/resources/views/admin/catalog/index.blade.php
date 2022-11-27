@extends('layouts.admin')
@section('header', 'Catalog')

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('catalogs/create') }}" class="btn btn-primary">Create new Catalog</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead align="center">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Total Books</th>
                                <th>Created at</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catalogs as $key => $catalog)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $catalog->name }}</td>
                                    <td align="center">{{ count($catalog->books) }}</td>
                                    <td align="center">{{ dateFormat($catalog->created_at) }}</td>
                                    <td>
                                        <a href="{{ url('catalogs/' . $catalog->id . '/edit') }}"
                                            class="btn btn-warning btn-sm">edit</a>
                                        <form action="{{ url('catalogs', ['id' => $catalog->id]) }}" method="POST">
                                            <input type="submit" class="btn btn-danger btn-sm" value="delete"
                                                onclick="return confirm('Are you sure?')" name="" id="">
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
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
