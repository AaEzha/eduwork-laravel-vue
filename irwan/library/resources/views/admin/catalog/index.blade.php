@extends('layouts.admin')
@section('header', 'Catalog')

@section('content')
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