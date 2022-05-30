@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left">Order Products</h4>
                        <a href="#" style="float: right" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addproduct"><i class=" fa fa-plus"></i>Add New Products</a>
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
                                            <label for="">Cutomer Name</label>
                                            <input type="text" name="customer_name" id="" class="form-control">
                                        </td>
                                        <td>
                                            <label for="">Cutomer Phone</label>
                                            <input type="text" name="customer_phone" id="" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                                <td> Payment Method <br>
                                    <span class="radio-item">
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
                                <td> <button class="btn-pimary btn-lg btn-block mt-3">Save</button>
                                </td>
                                <td> <button class="btn-danger btn-lg btn-block mt-2">Calculator</button>
                                </td>
                                <div class="text-center">
                                    <a href="#" class="text-danger"><i class="fa fa-sign-out-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal right fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('orders.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Qty</label>
                        <input type="number" name="qty" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alert Stock</label>
                        <input type="number" name="alert_stock" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">Save Data</button>
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
</style>
</div>
@endsection
@section('script')
<script>
    $('.add_more').on('click', function() {
        var product = $('.product_id').html();
        var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
        var tr = '<tr><td class"no"">' + numberofrow + '</td>' +
            '<td> <select class="form-control product_id" name="product_id[]">' + product + '</select></td>' +
            '<td> <input type="number" class="form-control qty" name="qty[]"></td>' +
            '<td> <input type="number" class="form-control price" name="price[]"></td>' +
            '<td> <input type="number" class="form-control discount" name="discount[]"></td>' +
            '<td> <input type="number" class="form-control total_amount" name="total_amount[]"></td>' +
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
</script>
@endsection
