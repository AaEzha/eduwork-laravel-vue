@extends('layouts.admin')

@section('title','Show Transaction')
@section('content')
<h2 class="mb-5">Transaction</h2>
<div class="col-md-6 m-auto">
    <div class="card p-4">
        <div class="card-body">
            <form>
                <h3>Transaction Detail</h3>
                @foreach ($transactions as $transaction)
                <div class="form-group row mt-4">
                    <div class="col-sm-3 mt-3 "> Name </div>
                    <div class="col-sm-9 mt-3">
                        : &nbsp; {{ $transaction->name }}
                    </div>

                    <div class="col-sm-3 mt-4"> Loan Date </div>
                    <div class="col-sm-9 mt-4">
                        : &nbsp; {{ $transaction->date_start }}
                    </div>

                    <div class="col-sm-3 mt-4"> Book selected </div>
                    <div class="col-sm-9 p-2 mt-4">
                        <div class="ps-3 pb-5 border rounded ">
                            <ol>
                                @foreach ($transactions as $transaction)
                                <li class="m-2">
                                    {{ $transaction->title}}
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        <input type="text" readonly class="form-control-plaintext" id="" value="">
                    </div>
                    <div class="col-sm-3 mt-4"> Status </div>
                    <div class="col-sm-9 mt-4">
                        @if ($transaction->status == 0)
                        : &nbsp; <div class="btn disabled btn-danger"> Not Returned </div>
                        @else
                        : &nbsp; <div class="btn disabled btn-success"> Returned </div>
                        @endif

                    </div>
                </div>
            </form>
            @endforeach
            <div class="d-flex justify-content-end">
                <a href="{{ url('transactions') }}" class="btn btn-dark">Back</a>
            </div>

        </div>
    </div>
</div>



@endsection