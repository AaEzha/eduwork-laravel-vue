@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')
    ini adalah halaman Catalog

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bordered Table</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <th>sawindri</th>
                        <th>nbdjfn</th>
                        <th>nbckbjsk</th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item">
                    <a href="#" class="page-link"><<</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">2</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">>></a>
                </li>
            </ul>
        </div>
    </div>
@endsection