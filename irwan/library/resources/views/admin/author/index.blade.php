@extends('layouts.admin')
@section('header', 'Author')

@section('content')

	<a href="{{ url('createauthor') }}" class="btn btn-sm btn-primary pull-right">Create New Author</a>
	<br> <br>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Address</th>
      <th scope="col">Craeted At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($authors as $key => $author)
    <tr>
      <th>{{ $key+1 }}</th>
      <td>{{ $author->name }}</td>
      <td>{{ $author->email }}</td>
      <td>{{ $author->phone_number }}</td>
      <td>{{ $author->address }}</td>
      <td>{{ $author->created_at }}</td>
       <td class="text-center">
        <a href="{{ url('edit') }}" class="btn btn-warning btn-sm">Edit</a>
         <form action="{{ url('authors', ['id' => $author->id]) }}" method="post">
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
