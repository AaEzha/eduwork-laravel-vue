<div class="modal right fade" id="deleteproduct{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">DELETED product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.destroy', $product->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <p>Are You Sure To Delete This product: {{$product->product_name}} ?</p>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-block">Deleted Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>