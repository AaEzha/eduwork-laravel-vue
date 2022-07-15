@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left">Order Products</h4>
                    </div>
                    <form action="{{route('orders.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Disc (%)</th>
                                        <th>Total</th>
                                        <th><a href="#" class="btn btn-sm btn-success rounded-circle add_more"><i class="fa fa-plus"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody class="addMoreProduct">
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="product_id[]" id="product_id" class="form-control product_id">
                                                <option value="" selected disabled hidden>Choose item...</option> @foreach($products as $product)
                                                <option data-price="{{$product->price}}" value="{{$product->id}}">{{$product->product_name}}</option>@endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="qty[]" id="qty" class="form-control qty">
                                        </td>
                                        <td>
                                            <input type="number" name="price[]" id="price" class="form-control price">
                                        </td>
                                        <td>
                                            <input type="number" name="discount[]" id="discount" class="form-control discount">
                                        </td>
                                        <td>
                                            <input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Total <b class="total">0.00</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="panel">
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <td>
                                            <label for="">Customer Name</label>
                                            <select name="customer_name" id="customer_name" class="form-control customer_name">
                                                <option value="" selected disabled hidden>Choose Name...</option> @foreach($customers as $customer)
                                                <option data-customer="{{$customer->phone}}" value="{{$customer->name}}">{{$customer->name}}</option>@endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <label for="">Customer Phone</label>
                                            <input type="text" size="10" name="customer_phone" id="customer_phone" class="form-control customer_phone" readonly>
                                        </td>
                                    </tr>
                                </table>
                                <td> Payment Method <br>
                                    <span class=" radio-item">
                                        <input type="radio" name="payment_method" id="payment_method" class="true" value="cash" checked="checked">
                                        <label for="payment_method"><i class="fa fa-money-bill text-success"></i> Cash</label>
                                    </span>
                                    <span class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_method" class="true" value="bank transfer">
                                        <label for="payment_method"><i class="fa fa-university text-danger"></i> Bank Transfer</label>
                                    </span>
                                    <span class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_method" class="true" value="credit card">
                                        <label for="payment_method"><i class="fa fa-credit-card text-info"></i> Credit Card</label>
                                    </span>
                                </td> <br>
                                <td>
                                    Payment <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                                </td>
                                <td>
                                    Returning Change <input type="number" readonly name="balance" id="balance" class="form-control">
                                </td>
                                <td> <button class="btn btn-info mt-3">Save</button>
                                </td>
                                <td> <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark"><i class="fa fa-print"></i> Print</button></button>
                                </td>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="print" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">
                    <center>TOKOKU</center>
                </h2>
                <div class="mid">
                    <div class="info">
                        <h4> Contact Us</h4>
                        <p> Address: Rejoso, Pasuruan, Indonesia <br>
                            Email: elkira03@gmail.com <br>
                            Phone: 082248969890</p>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div class="bot">
                            <div id="table">
                                <table class="table dark">
                                    <thead>
                                        <tr>
                                            <td class="item">
                                                <h4>Item</h4>
                                            </td>
                                            <td class="hour">
                                                <h4>Qty</h4>
                                            </td>
                                            <td class="rate">
                                                <h4>Price</h4>
                                            </td>
                                            <td class="rate">
                                                <h4>Discount</h4>
                                            </td>
                                            <td class="rate">
                                                <h4>Sub Total</h4>
                                            </td>
                                        </tr>
                                        @foreach($order_receipt as $receipt)
                                        <tr class="service">
                                            <td class="tableitem">
                                                <p class="itemtext">{{$receipt->product->product_name}}</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext">{{$receipt->qty}}</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext">{{rupiah($receipt->price)}}</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext">{{number_format($receipt->discount)}}%</p>
                                            </td>
                                            <td class="tableitem">
                                                <p class="itemtext">{{rupiah($receipt->amount)}}</p>
                                            </td>
                                        </tr>
                                        <tr class="tabletitle">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" Rate">
                                                <p class="itemtext">Tax</p>
                                            </td>
                                            <td class="Payment">
                                                <p class="itemtext">{{rupiah($receipt->amount*0.11)}}</p>
                                            </td>
                                        </tr>
                                        <tr class="tabletitle">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=" Rate">
                                                <p class="itemtext">Total</p>
                                            </td>
                                            <td class="Payment">
                                                <p class="itemtext">{{rupiah($receipt->sum('amount'))}}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                </table>
                                <div class=" leagalcopy">
                                    <p class=" legal"><strong>*** Thank you for your purchasing ***</strong><br></p>
                                </div>
                                <div class="serial-number">
                                    <span>Serial Code: @foreach($order_receipt as $receipt) {{$receipt->id}}@endforeach</span><br>
                                    <span>Member Name: @foreach($order_receipt as $receipt) {{$receipt->name}}@endforeach</span><br>
                                    <span> Date:
                                        <?php
                                        date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
                                        echo date('l, d-m-Y  H:i:s'); //kombinasi jam dan tanggal
                                        ?>
                                    </span>
                                </div>
                                </thead>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .modal.right .modal-dialog {
        top: 0;
        right: 0;
        margin-right: 15vh;
    }

    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }

    #invoice-POS {
        box-shadow: 0 0 1in --0.25in rgb(0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 58mm;
        background: #fff;
    }

    #invoice-POS::selection {
        background: #34495E;
        color: #fff;
    }

    #invoice-POS ::-moz-selection {
        background: #34495E;
        color: #fff;
    }

    #invoice-POS h1 {
        font-size: 1.5em;
        color: #222;
    }

    #invoice-POS h2 {
        font-size: 0.5em;
    }

    #invoice-POS h3 {
        font-size: 1.2em;
        font-weight: 300;
        line-height: 2em;
    }

    #invoice-POS p {
        font-size: 0.7em;
        line-height: 2em;
        color: #666;
    }

    #invoice-POS #top,
    #invoice-POS #mid,
    #invoice-POS #bot {
        border-bottom: 1px solid #eee;
    }

    #invoice-POS #top {
        min-height: 100px;
    }

    #invoice-POS #mid {
        min-height: 80px;
    }

    #invoice-POS #bot {
        min-height: 50px;
    }

    #invoice-POS #top .logo {
        height: 60px;
        width: 60px;
        background-image: url() no-repeat;
        background-size: 60px 60px;
        border-radius: 50px;
    }

    #invoice-POS .info {
        display: block;
        margin-left: 0;
        text-align: center;
    }

    #invoice-POS .title {
        float: right;
    }

    #invoice-POS .title p {
        text-align: right;
    }

    #invoice-POS table {
        width: 100%;
        border-collapse: collapse;
    }

    #invoice-POS tabletitle {
        font-size: 0, 5em;
        background: #eee;
    }

    #invoice-POS .service {
        border-bottom: 1px solid #eee;
    }

    #invoice-POS .item {
        width: 24mm;
    }

    #invoice-POS .itemtext {
        font-size: 0.5em;
    }

    #invoice-POS #legalcopy {
        margin-top: 5mm;
        text-align: center;
    }

    .serial-number {
        margin-top: 5mm;
        margin-bottom: 2mm;
        text-align: center;
        font-size: 12px;
    }

    .serial {
        font-size: 10px !important;
    }
</style>
</div>
@endsection
@section('script')
<script>
    $('.add_more').on('click', function() {
        var product = $('.product_id').html();
        var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
        var tr = '<tr><td class"no"">' + numberofrow + '</td>' +
            '<td> <select class="form-control product_id" name"product_id[]">' + product + '</select></td>' +
            '<td> <input type="number" class="form-control qty" name"qty[]"></td>' +
            '<td> <input type="number" class="form-control price" name"price[]"></td>' +
            '<td> <input type="number" class="form-control discount" name"discount[]"></td>' +
            '<td> <input type="number" class="form-control total_amount" name"total_amount[]"></td>' +
            '<td><a class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-times-circle"></i></a></td>';
        $('.addMoreProduct').append(tr);
    });

    //delete a row
    $('.addMoreProduct').delegate('.delete', 'click', function() {
        $(this).parent().parent().remove();
    });

    function TotalAmount() {
        var total = 0;
        $('.total_amount').each(function(i, e) {
            var amount = $(this).val() - 0;
            total += amount;
        });
        $('.total').html(total);
    };

    $('.addMoreProduct').delegate('.product_id', 'change', function() {
        var tr = $(this).parent().parent();
        var price = tr.find('.product_id option:selected').attr('data-price');
        tr.find('.price').val(price);
        var qty = tr.find('.qty').val() - 0;
        var disc = tr.find('.discount').val() - 0;
        var price = tr.find('.price').val() - 0;
        var total_amount = (qty * price) - ((qty * price * disc) / 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount();
    });

    $('.addMoreProduct').delegate('.qty, .discount', 'keyup', function() {
        var tr = $(this).parent().parent();
        var qty = tr.find('.qty').val() - 0;
        var disc = tr.find('.discount').val() - 0;
        var price = tr.find('.price').val() - 0;
        var total_amount = (qty * price) - ((qty * price * disc) / 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount();
    });

    $('#paid_amount').keyup(function() {
        var total = $('.total').html();
        var paid_amount = $(this).val();
        var tot = paid_amount - total;
        $('#balance').val(tot).toFixed(2);
    })

    function PrintReceiptContent(el) {
        var data = '<input type= "button" id="printPageButton" class="printPageButton" style="display:block; width=100%; border: none; background-color: #008B8B; color: #fff; padding:14px 28px; font-size: 16px; cursor:pointer; text-align:center" value="Print Receipt" onClick="window.print()">';
        data += document.getElementById(el).innerHTML;
        myReceipt = window.open("", "myWin", "left=150,top=130,width=400,height=400");
        myReceipt.screnX = 0;
        myReceipt.screnY = 0;
        myReceipt.document.write(data);
        myReceipt.document.title = "Print Receipt";
        myReceipt.focus();
        setTimeout(() => {
            myReceipt.close();
        }, 100000);

    }

    $('#customer_name').on('change', function() {
        var phone = $('.customer_name option:selected').attr('data-customer');
        $('.customer_phone').val(phone);
    });

    Swal.fire(
        'Please Check Notifications Before Create New Orders',
        'Thank You',
        'warning'
    )
</script>
@endsection