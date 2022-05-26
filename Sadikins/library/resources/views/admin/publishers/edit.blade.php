@extends('layouts.admin')

@section('title','Create New publisher')
@section('content')
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mt-3"> Edit Publishers </h4>
                <form action="{{ route('publishers.update', $publisher->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control form-control-lg" name="name" value="{{ old('name') ?? $publisher->name }}"  required>
                </div>
                 <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') ?? $publisher->email }}"  required>
                </div>
                 <div class="form-group">
                <label for="">Phone Number</label>
                <input type="text" class="form-control form-control-lg" name="phone_number" value="{{ old('phone_number') ?? $publisher->phone_number }}"  required>
                </div>
                 <div class="form-group">
                <label for="">Address</label>
                <input type="text" class="form-control form-control-lg" name="address" value="{{ old('address') ?? $publisher->address }}"  required>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
