@extends('layouts.admin')

@section('title','Create New Catalog')
@section('content')
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mt-3"> Edit Catalogs </h4>
                <form action="{{ route('catalogs.update', $catalog->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control form-control-lg" name="name" value="{{ old('name') ?? $catalog->name }}"  required>

                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
