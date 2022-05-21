@extends('layouts.admin')

@section('header', 'Author')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Table Data Author</h3>
    </div>
    <div class="card-body">
        <a href="{{ url('authors/create') }}" class="btn btn-primary mb-3">Create New Author</a>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone Number</td>
                    <td>Address</td>
                    <td>Opsi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $key => $a)    
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->phone_number }}</td>
                        <td>{{ $a->address }}</td>
                        <td>
                            <a href="{{ url('authors/'.$a->id.'/edit') }}" class="btn btn-warning btn-sm">edit</a>
                            <form action="{{ url('authors', ['id' => $a->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input class="btn btn-danger btn-sm" type="submit" value="delete" onclick="return confirm('Are you sure?')">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>
        {{-- {{ $authors->links() }} --}}
    </div>
</div>
@endsection