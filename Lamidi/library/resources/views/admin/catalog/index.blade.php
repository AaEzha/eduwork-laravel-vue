@extends('layouts.admin')
@section('header','Catalog')
@section('content')
HALAMAN Catalog
<br><br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Catalog</h3>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($catalogs as $key => $catalog)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$catalog->name}}</td>
                            <td>{{count($catalog->books)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection