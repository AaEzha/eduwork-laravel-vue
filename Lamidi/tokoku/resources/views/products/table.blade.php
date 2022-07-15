<table id="example1" class="table table-bordered table-left">
    <thead>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Alert Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($products->count() == 0)
        <tr>
            <td colspan="5">No products to display.</td>
        </tr>
        @endif

        @foreach ($products as $key => $product)
        <tr>
            <td>{{$key+1}}</td>
            <td style="cursor: pointer" data-toggle="tooltip" data-placemet="right" title="Click to view Detail" wire:click="ProductDetails({{$product->id}})">{{$product->product_name}}</td>
            <td>{{$product->brand}}</td>
            <td>{{rupiah($product->price)}}</td>
            <td>
                @if ($product->alert_stock > $product->qty) <span class="text text-danger">
                    Low Stock</span>
                @else
                <span class="text text-success">In Stock</span>
                @endif
            </td>
            <td>
                <div class="btn-group">
                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editproduct{{$product->id}}"> <i class=" fa fa-edit"></i>Edit</a>
                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteproduct{{$product->id}}"> <i class=" fa fa-trash"></i>Delete</a>
                </div>
            </td>
        </tr>
        <!-- Modal of Edit product Detail -->
        @include('products.edit')
        <!-- Modal of Delete product-->
        @include('products.delete')
        @endforeach
    </tbody>
</table>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>