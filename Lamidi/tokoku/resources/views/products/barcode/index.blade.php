@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left">Products barcodes</h4>
                        <div class="card-body">
                            <div id="print">
                                <div class="row">
                                    @forelse($productbarcodes as $barcodes)
                                    <div class="text-center col-lg-4 mt-5 col-sm-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{asset('assets/products/barcodes/'.$barcodes->barcode)}}">
                                                <h4 class="text-center" style="padding: 1em; margin-top:0.5em">{{$barcodes->product_code}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <h2 align='center'>No Data</h2>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection