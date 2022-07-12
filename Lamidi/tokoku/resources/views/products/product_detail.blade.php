<div class="row">
    @forelse($products_details as $product)
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Product ID</label>
            <img data-bs-toggle="modal" data-bs-target="#product_preview{{$product->id}}" src="{{asset('assets/products/images/'.$product->product_image)}}" width="70" style="cursor: pointer;"></span>
            <input type="text" class="form-control" value="{{$product->id}}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" class="form-control" value="{{$product->product_name}}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Product Code</label>
            <input type="text" class="form-control" value="{{$product->product_code}}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Product Price</label>
            <input type="text" class="form-control" value="{{$product->price}}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label>Supplier</label>
        <select name="supplier" id="" class="form-control" disabled>
            @foreach($suppliers as $supplier)
            <option value="{{$product->supplier}}" {{($supplier->id == $product->supplier) ? "selected" : "" }}>{{ $supplier->supplier_name }}</option>
            @endforeach
        </select>
    </div>
    <div class=" col-md-12">
        <div class="form-group">
            <label for="">Product Qty</label>
            <input type="text" class="form-control" value="{{$product->qty}}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Alert Stock</label>
            <input type="text" class="form-control" value="{{$product->alert_stock}}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Product Description</label>
            <textarea class="form-control" readonly cols="10" rows="2">{{$product->description}}</textarea>
        </div>
    </div>
    <br><br><br><br>
    <div class="col-md-12">
        <div class="form-group" style="text-align: center !important; padding-left:10%">
            <span style="text-align: center;">
                <img src="{{asset('assets/products/barcodes/'.$product->barcode)}}" width="70" style="cursor: pointer;"></span>
            <h5>{{$product->product_code}}</h5>
        </div>
    </div>
    @include('products.product_preview')
    @empty
    @endforelse
</div>
<style>
    input:read-only {
        background: #fff !important;
    }

    textarea:read-only {
        background: #fff !important;
    }
</style>