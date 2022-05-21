@extends('layouts.admin')

@section('header', 'Publisher')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Table Data Publisher</h3>
    </div>
    <div class="card-body">
        <a href="{{ url('publishers/create') }}" class="btn btn-primary mb-3">Create New Publisher</a>
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
                @foreach ($publishers as $key => $p)    
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->phone_number }}</td>
                        <td>{{ $p->address }}</td>
                        <td>
                            <a href="{{ url('publishers/'.$p->id.'/edit') }}" class="btn btn-warning btn-sm">edit</a>
                            <form action="{{ url('publishers', ['id' => $p->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input class="btn btn-danger btn-sm" type="submit" value="delete" onclick="return confirm('Are you sure?')">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>
        {{-- {{ $publishers->links() }} --}}
    </div>
</div>
@endsection