@extends('layouts.admin')
@section('header', 'Catalog')

@section('content')

	<a href="{{ url('create') }}" class="btn btn-sm btn-primary pull-right">Create New Catalog</a>
	<br> <br>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Total Books</th>
      <th scope="col">Craeted At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($catalogs as $key => $catalog)
    <tr>
      <th>{{ $key+1 }}</th>
      <td>{{ $catalog->name }}</td>
      <td>{{ count($catalog->books) }}</td>
      <td>{{ $catalog->created_at }}</td>
      <td class="text-center">
        <a href="{{ url('edit') }}" class="btn btn-warning btn-sm">Edit</a>
         <form action="{{ url('catalogs', ['id' => $catalog->id]) }}" method="post">
        <input class="btn btn-danger btn-sm" type="submit" value="Delete" onclick="return confirm('Are You sure?')">
        @method('delete')
        @csrf
      </form>
      </td>
    </tr> 
    @endforeach
  </tbody>
</table>

@endsection