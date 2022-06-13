@extends('layouts.admin')

@section('header', 'Data Transaksi')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="col-md-6 m-auto">
        <div class="card p-4">
        <div class="card-body">
            <form action="{{ url('transactions') }}" method="POST">
                @csrf
                <h3>Create Transaction</h3>
                <div class="form-group row mt-4">
                    <div  class="col-sm-3 mt-3 ">Name</div>
                    <div class="col-sm-9 mt-3">
                        <select name="member" id="member" class="form-select form-control-lg pt-3 @error('member') is-invalid @enderror">
                             <option selected disabled>Pilih Member</option>
                            @foreach ($members as $member)
                            <option {{ $member->id == $transaction->member_id ? 'selected' : '' }} value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                         @error('member')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div  class="col-sm-3 mt-5"> Loan Date </div>
                    <div class="col-sm-9 mt-5 row">
                        <div class="col-6 d-flex justify-content-between">
                            <input type="date" name="date_start" class="form-control form-control-lg @error('date_start') is-invalid @enderror">
                            <span class="icon-calendar calendar-icon ps-3 mt-2" style="font-size:30px; "></span>

                            @error('date_start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <div class="col-6 d-flex justify-content-between">
                            <input type="date" name="date_end" class="form-control form-control-lg @error('date_end') is-invalid @enderror">
                            <span class="icon-calendar calendar-icon ps-3 mt-2" style="font-size:30px; "></span><br><br>
                             @error('date_end')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    </div>

                    <div class="mt-5 d-flex justify-content-between">
                        <div  class="col-sm-3 ">Book</div>
                        <div class="col-sm-9 p-2">

                        <select class="js-example-basic-multiple w-100 my-3 @error('books') is-invalid @enderror" name="books[]" id="books" multiple="multiple">
                            @foreach ($books as $book)

                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                            </select>

                             @error('books')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary mb-2">Save Transaction</button>
                    </div>
                </form>

        </div>
    </div>
</div>



@endsection

@section('js')
<script>
    $('.datepicker').datepicker();
</script>
<script>
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>

@endsection