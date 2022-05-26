@extends('layouts.admin')

@section('title','Create New Catalog')
@section('content')
<div class="col-md-6">
<div class="card">
<div class="card-body">
    <h4 class="card-title mt-3"> Create publishers </h4>
<form action="{{ route('publishers.store') }}" method="post">
@csrf
 <div class="form-group">
 <label for="">Name</label>
    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter name.." required>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
<div class="form-group">
 <label for="">Email</label>
    <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email.." required>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
<div class="form-group">
 <label for="">Phone Number</label>
    <input type="text" class="form-control form-control-lg @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="Enter phone_number.." required>
    @error('phone_number')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
<div class="form-group">
 <label for="">Address</label>
    <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Enter addrees.." required>
    @error('address')
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
