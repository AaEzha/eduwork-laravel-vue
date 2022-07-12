<div class="modal right fade" id="editproduct{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">EDIT product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" id="" value="{{$product->product_name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Product Code</label>
                        <input type="text" name="product_code" id="" value="{{$product->product_code}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="" value="{{$product->brand}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" id="" value="{{$product->price}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier[]" class="form-control">
                            @foreach($suppliers as $supplier)
                            <option value="{{$product->supplier}}" {{($supplier->id == $product->supplier) ? "selected" : "" }}>{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Qty</label>
                        <input type="number" name="qty" id="" value="{{$product->qty}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alert Stock</label>
                        <input type="number" name="alert_stock" id="" value="{{$product->alert_stock}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control">{{$product->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <img width="40" src="{{asset('assets/products/images/'.$product->product_image)}}">
                        <input type="file" name="product_image" id="" class="form-control">{{$product->product_image}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning btn-block">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>