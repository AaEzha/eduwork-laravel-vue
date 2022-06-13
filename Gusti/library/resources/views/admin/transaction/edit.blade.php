@extends('layouts.admin')

@section('header', 'Edit Transaction')

@section('css')

<!-- Multiple Select-->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-md-6 m-auto">
    <div class="card p-4">
        <div class="card-body">
            <form action="{{ url('transactions/'. $transaction->id) }}" method="POST" enctype="multipart/form-data">
                {{method_field('PUT')}}
                @csrf
                <h3>Edit Transaction</h3>
                <br>
                <div class="form-group col-sm-5 row">
                    <label>Member Name</label>
                    <input type="hidden" name="member" value="{{ $transaction->member_id }}">
                    <select name="memberx" id="member" class="form-control" disabled>
                        @foreach ($members as $member)
                        <option {{ $member->id == $transaction->member_id ? 'selected' : '' }} value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>
                <label> Loan Date </label>
                <div class="col-sm-10 row">
                    <div class="col-6 d-flex justify-content-between">
                        <input type="hidden" name="date_start" value="{{ old('date_start', $transaction->date_start) }}">
                        <input type="date" name="date_startx" class="form-control" value="{{ old('date_start') ?? $transaction->date_start }}" readonly>
                        <span class="icon-calendar"></span>
                    </div>
                    <div class="col-6 d-flex justify-content-between">
                        <input type="date" name="date_end" class="form-control" value="{{ old('date_end') ?? $transaction->date_end }}">
                        <span class="icon-calendar"></span><br>
                    </div>
                </div>
                <br>
                <label>Book Selected</label><br>
                <div class="select2-purple">
                    <select class="select2" name="books[]" id="books" multiple='multiple'>
                        @foreach($books as $book)
                        <option {{ $transaction->books()->find($book->id) ? 'selected' : '' }} value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select><br>
                </div>
                <label> Status </label>
                <div class="mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" {{ $transaction->status == 0 ? 'checked' : '' }} value="0">
                        <label class="form-check-label" for="status">
                            No Returned
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" {{ $transaction->status == 1 ? 'checked' : '' }} value="1">
                        <label class="form-check-label" for="status">
                            Returned
                        </label>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ url('transactions') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary mb-2">Save Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- Multiple Select -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.datepicker').datepicker();
    });
</script>
@endsection