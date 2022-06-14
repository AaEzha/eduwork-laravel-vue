<div class="col-lg-12">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 style="float: left">Order Products</h4>
                    <a href="#" style="float: right" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addproduct"><i class=" fa fa-plus"></i>Add New Products</a>
                </div>
                <div class="card-body">
                    <div class="my-2">
                        <form wire:submit.prevent="insertocart">
                            <input type="text" name="" wire:model="product_code" id="" class="form-control" placeholder="Enter Product Code ...">
                        </form>
                    </div>
                    <div class="alert alert-success">{{$message}}</div>
                    {{$productincart}}
                    <table class="table table-bordered table-left">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Disc (%)</th>
                                <th colspan="6">Total</th>
                                <th><a href="#" class="btn btn-sm btn-success rounded-circle add_more"><i class="fa fa-plus"></i></a></th>
                            </tr>
                        </thead>
                        <tbody class="addMoreProduct">
                            @foreach($productincart as $key=> $cart)
                            <tr>
                                <td class="no">{{$key+1}}</td>
                                <td width='25%'>
                                    <input type="text" class="form-control" value="{{$cart->products->product_name}}" name="" id="">
                                </td>
                                <td>
                                    <input type="number" value="{{$cart->product_qty}}" name="" id="">
                                </td>
                                <td>
                                    <input type="number" value="{{$cart->product_price}}" name="" id="">
                                </td>
                                <td>
                                    <input type="number" name="discount[]" id="discount" class="form-control discount">
                                </td>
                                <td>
                                    <input type="number" name="total_amount[]" id="total_amount" value="{{$cart->product_qty*$cart->product_price}}" class="form-control total_amount">
                                </td>
                                <td><a href="#" class="btn btn-sm btn-danger rounder-circle"><i class="fa fa times" wire:click="removeproduct{{$cart->id}}"></i></a></td>
                            </tr>
                            @endforeach
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
                    <div class="btn-group">
                        <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
                        <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark"><i class="fa fa-print"></i> History</button>
                        <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark"><i class="fa fa-print"></i> Report</button>

                    </div>
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