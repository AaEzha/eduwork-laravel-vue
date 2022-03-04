@extends('layouts.admin')
@section('header','Catalog')
@section('content')
HALAMAN Catalog
<br><br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{url('catalogs/create')}}" class="btn btn-sm btn-primary pull-right">Create New Catalog</a>
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
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Total Books</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($catalogs as $key => $catalog)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$catalog->name}}</td>
                            <td>{{count($catalog->books)}}</td>
                            <td><a href="{{url('catalogs/'.$catalog->id.'/edit')}}" class="btn btn-sm btn-warning pull-right">Edit</a></td>
                            <td>
                                <form action="{{url('catalogs',['id'=>$catalog->id])}}" method="POST">
                                    <input class="btn btn-danger btn-sm" type="submit" value="Delete" onclick="return confirm('Are you sure ?')">
                                    @method('delete')
                                    @csrf
                                </form>
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