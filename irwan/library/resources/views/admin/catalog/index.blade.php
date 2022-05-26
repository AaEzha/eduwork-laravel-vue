@extends('layouts.admin')
@section('header', 'Catalog')

@section('content')

	<a href="{{ url('catalogs/create') }}" class="btn btn-sm btn-primary pull-right">Create New Catalog</a>
	<br> <br>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Total Books</th>
      <th scope="col">Craeted At</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($catalogs as $key => $catalog)
    <tr>
      <th>{{ $key+1 }}</th>
      <td>{{ $catalog->name }}</td>
      <td>{{ count($catalog->books) }}</td>
       <td>{{ $catalog->created_at }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection