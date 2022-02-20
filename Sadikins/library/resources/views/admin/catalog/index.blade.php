@extends('layouts.admin')

@section('title','Catalog')
@section('content')
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                  <h4 class="card-title mt-3">Catalogs </h4>
                  <div>
                      <a href="{{ route('catalogs.create') }}" class="btn  btn-primary">Add New Catalog &nbsp; +</a>
                  </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover ">
                      <thead>
                        <tr>
                          <th width="10">#</th>
                          <th>Nama</th>
                          <th >Total Books</th>
                          <th >Created At</th>
                          <th >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($catalogs as $key => $catalog)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $catalog->name }}</td>
                            <td class="text-center text-primary"><b>{{ count($catalog->books) }}</b></td>
                            <td >{{ $catalog->date }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                <a href="{{ route('catalogs.edit', $catalog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="post">
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
