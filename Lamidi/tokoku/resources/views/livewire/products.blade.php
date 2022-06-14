<div>
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="float: left">Add Products</h4>
                            <a href="#" style="float: right" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addproduct"><i class=" fa fa-plus">Add New Products</i></a>
                            <br><br>
                            <div class="card-body">
                                @include('products.table')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product Details</h4>
                            <div class="card-body"></div>
                            @include('products.product_detail')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>