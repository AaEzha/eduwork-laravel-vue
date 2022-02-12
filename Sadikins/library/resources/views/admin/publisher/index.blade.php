@extends('layouts.admin')

@section('title','publisher')
@section('content')
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                  <h4 class="card-title mt-3">publishers </h4>
                  <div>
                      <a href="{{ route('publishers.create') }}" class="btn  btn-primary">Add New publisher</a>
                  </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover ">
                      <thead>
                        <tr>
                          <th width="10">#</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th>Address</th>
                          <th >Total Books</th>
                          <th >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($publishers as $key => $publisher)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $publisher->name }}</td>
                            <td>{{ $publisher->email }}</td>
                            <td>{{ $publisher->phone_number }}</td>
                            <td>{{ $publisher->address }}</td>
                            <td >{{ count($publisher->books) }}</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('publishers.destroy', $publisher->id) }}" method="post">
                                    <input type="submit" class="btn btn-sm btn-danger ms-2" value="Delete" onclick="return confirm('Are you sure?')">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection
