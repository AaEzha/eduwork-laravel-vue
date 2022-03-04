@extends('layouts.admin')
@section('header','Author')
@section('content')
HALAMAN Author
<br><br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{url('authors/create')}}" class="btn btn-sm btn-primary pull-right">Create New author</a>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $key => $author)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$author->name}}</td>
                            <td>{{$author->email}}</td>
                            <td>{{$author->phone_number}}</td>
                            <td>{{$author->address}}</td>
                            <td>{{count($author->books)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection