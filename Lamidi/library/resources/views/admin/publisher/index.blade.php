@extends('layouts.admin')
@section('header','Publisher')
@section('content')
HALAMAN Publisher
<br><br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{url('publishers/create')}}" class="btn btn-sm btn-primary pull-right">Create New publisher</a>
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
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Total Books</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publishers as $key => $publisher)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$publisher->name}}</td>
                            <td>{{$publisher->email}}</td>
                            <td>{{$publisher->phone_number}}</td>
                            <td>{{$publisher->address}}</td>
                            <td>{{count($publisher->books)}}</td>
                            <td><a href="{{url('publishers/'.$publisher->id.'/edit')}}" class="btn btn-sm btn-warning">Edit</a></td>
                            <td>
                                <form class="" action="{{url('publishers',['id'=>$publisher->id])}}" method="POST">
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