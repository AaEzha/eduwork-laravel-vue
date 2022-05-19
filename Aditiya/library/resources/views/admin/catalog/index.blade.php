@extends('layouts.admin')
@section('header','Catalog')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ini adalah halaman catalog
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Total Books</th>
                                    <th class="text-center">Date Created</th>
                                    <th class="text-center" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($catalogs as $key => $catalog)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $catalog->name }}</td>
                                    <td class="text-center">{{ count($catalog->books) }}</td>
                                    <td class="text-center">{{ date('H:i:s - d M y', strtotime( $catalog->created_at ))}}</td>
                                    <td><a href="" class="btn btn-sm btn-success pull-right">Edit</a></td>
                                    <td>
                                        <form action="" method="">
                                            <input class="btn btn-danger btn-sm" type="submit" value="Delete" onclick="return confirm('Are you sure ?')">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!--div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div-->
            </div>
        </div>
    </div>
</div>
@endsection