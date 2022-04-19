@extends('layouts.admin')
@section('title','Edit Transaction')
@section('css')
<!-- Multiple Select-->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
@endsection
@section('content')
<div class="col-md-6 m-auto">
    <div class="card p-4">
        <div class="card-body">
            <form action="{{ url('transactions/', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                {{method_field('PUT')}}
                @csrf
                <h3>Edit Transaction</h3>
                <br>
                <div class="form-group col-sm-5 row">
                    <label>Member Name</label>
                    <select name="member" id="member" class="form-control" disabled>
                        @foreach ($members as $member)
                        <option {{ $member->id == $transaction->member_id ? 'selected' : '' }} value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>
                <label> Loan Date </label>
                <div class="col-sm-10 row">
                    <div class="col-6 d-flex justify-content-between">
                        <input type="date" name="date_start" class="form-control" value="{{ old('date_start') ?? $transaction->date_start }}" disabled>
                        <span class="icon-calendar"></span>
                    </div>
                    <div class="col-6 d-flex justify-content-between">
                        <input type="date" name="date_end" class="form-control" value="{{ old('date_end') ?? $transaction->date_end }}">
                        <span class="icon-calendar"></span><br>
                    </div>
                </div>
                <br>
                <label>Book Selected</label><br>
                <select class="js-example-basic-multiple" name="books[]" id="books" multiple='multiple'>
                    <!-- @foreach($books as $book)
                    <option value="{{ $book->id }}" @if($transaction->books()->find($book->id)) ? 'selected' : '' @endif>{{ $book->title }}</option>
                    @endforeach -->
                    {{-- daftar buku --}}
                    @foreach($books as $key=> $book)

                    <option {{ $transaction->books()->find($book->id) ? 'selected' : '' }} value="{{ $book->id }}">{{ $key+1 }} . {{ $book->title }}</option>

                    @endforeach
                </select><br>

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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.datepicker').datepicker();
    });
</script>
@endsection