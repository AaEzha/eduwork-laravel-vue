@extends('layouts.admin')

@section('title','Create New Catalog')
@section('content')
<div class="col-md-6">
<div class="card">
<div class="card-body">
    <h4 class="card-title mt-3"> Create Catalogs </h4>
<form action="{{ route('catalogs.store') }}" method="post">
@csrf
 <div class="form-group">
 <label for="">Username</label>
    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter name.." required>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
<button type="submit" class="btn btn-primary me-2">Submit</button>
</form>
</div>
</div>
</div>


@endsection
