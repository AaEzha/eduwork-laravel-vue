@extends('layouts.admin')

@section('title','Edit Transaction')
@section('content')
<h2 class="mb-5">Transaction</h2>
<div class="col-md-6 m-auto">
        <div class="card p-4">
        <div class="card-body">
            <form action="{{ url('transactions', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <h3>Edit Transaction</h3>
                <div class="form-group row mt-4">
                    <div  class="col-sm-3 mt-3 ">Name</div>
                    <div class="col-sm-9 mt-3">
                        <select name="member" id="member" class="form-select form-control-lg pt-3 @error('member') is-invalid @enderror">
                            <option selected disabled>Choose one!</option>
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
                            <input type="date" name="date_start" class="form-control form-control-lg @error('date_start') is-invalid @enderror" value="{{ old('date_start') ?? $transaction->date_start }}">
                            <span class="icon-calendar calendar-icon ps-3 mt-2" style="font-size:30px; "></span>

                            @error('date_start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <div class="col-6 d-flex justify-content-between">
                            <input type="date" name="date_end" class="form-control form-control-lg @error('date_end') is-invalid @enderror" value="{{ old('date_end') ?? $transaction->date_end }}">
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

                            {{-- daftar buku --}}
                            @foreach($books as $key=>  $book)

                            <option {{ $transaction->books()->find($book->id) ? 'selected' : '' }}  value="{{ $book->id }}">{{ $key+1 }} . {{ $book->title }}</option>
                                
                            @endforeach
                           
                        </select>

                             @error('books')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                <div class="mt-4 d-flex">
                    <div  class="col-sm-4 mt-4">  Status </div>
                    <div class="col-sm-8 mt-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status"  {{ $transaction->status == 0 ? 'checked' : '' }} value="0" >
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
                </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary mb-2">Save Change</button>
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
