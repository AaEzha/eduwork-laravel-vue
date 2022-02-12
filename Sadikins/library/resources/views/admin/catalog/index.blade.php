@extends('layouts.admin')

@section('title','Catalog')
@section('content')
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Catalogs </h4>
                  <p class="card-description">
                    All Catalogs
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover ">
                      <thead>
                        <tr>
                          <th width="10">#</th>
                          <th>Nama</th>
                          <th class="text-center">Total Books</th>
                          <th class="text-center">Created At</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($catalogs as $key => $catalog)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $catalog->name }}</td>
                            <td class="text-center">{{ count($catalog->books) }}</td>
                            <td class="text-center">{{ $catalog->created_at }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection
