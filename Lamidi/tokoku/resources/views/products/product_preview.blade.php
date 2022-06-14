<div class="modal right fade" id="product_preview{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{$product->product_name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="">
                    <img src="{{asset('assets/products/images/'.$product->product_image)}}" width="250" style="cursor: pointer;">
                </div>
                <div>
                    <img src="{{asset('assets/products/barcodes/'.$product->barcode)}}" width="250" style="cursor: pointer;">
                </div>
            </div>
        </div>
    </div>
</div>