@extends('layouts.admin')
@section('title','Add Transaction')
@section('css')
<!-- Multiple Select-->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ url('transactions') }}" method="POST">
            <div class=" modal-header">
                <h4 class="modal-title"> Add Transaction</h4>
            </div>
            <div class="modal-body">
                @csrf
                <label>Member Name</label>
                <select name="member" id="member" class="form-select form-control col-sm-4">
                    <option selected disabled>Select Member</option>
                    @foreach ($members as $member)
                    <option {{ $member->id == $transaction->member_id ? 'selected' : '' }} value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
                <label> Loan & Return Date </label>
                <div class="col-sm-9 row">
                    <div class="col-6 d-flex justify-content-between">
                        <input type="date" name="date_start" class="form-control">
                        <span class="icon-calendar calendar-icon" style="font-size:10%; "></span>
                    </div>
                    <div class="col-6 d-flex justify-content-between">
                        <input type="date" name="date_end" class="form-control">
                        <span class="icon-calendar calendar-icon" style="font: size 10%; "></span><br><br>
                    </div>
                </div>
                <label> Select Book</label>
                <div class="select2-purple">
                    <select class="select2" name="books[]" id="books" multiple="multiple">
                        @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="{{ url('transactions') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary mb-2">Save Transaction</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<!-- Multiple Select -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $('.datepicker').datepicker();
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection