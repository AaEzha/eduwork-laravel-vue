@extends('layouts.admin')
@section('header', 'Publisher')

@section('content')

	<a href="{{ url('createpublisher') }}" class="btn btn-sm btn-primary pull-right">Create New Publisher</a>
	<br> <br>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Adress</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($publishers as $key => $publisher)
    <tr>
      <th>{{ $key+1 }}</th>
      <td>{{ $publisher->name }}</td>
      <td>{{ $publisher->email }}</td>
      <td>{{ $publisher->phone_number }}</td>
      <td>{{ $publisher->address }}</td>
      <td>{{ $publisher->created_at }}</td>
      <td class="text-center">
        <a href="{{ url('edit') }}" class="btn btn-warning btn-sm">Edit</a>
         <form action="{{ url('publishers', ['id' => $publisher->id]) }}" method="post">
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