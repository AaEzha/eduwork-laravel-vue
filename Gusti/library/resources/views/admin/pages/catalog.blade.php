@extends('layouts.admin')

@section('header', 'Catalog')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Data Catalog</h1>
                        
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 10px">No</th>
                                    <th>Name</th>
                                    <th>Total Buku</th>
                                    <th>Create At</th>
                                    <th>Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($catalogs as $catalog)    
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $catalog->name }}</td>
                                    <td class="text-center">{{ count($catalog->books) }}</td>
                                    <td class="text-center">{{ date('d/M/Y', strtotime($catalog->created_at)) }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary ">Edit</button>
                                        <button type="button" class="btn btn-danger ">Delete</button>
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
