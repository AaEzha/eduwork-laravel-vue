<a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class=" btn btn-outline rounded-pill"><i class="fa fa-list"></i></a>
@role('admin')
<a href="{{route('home')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-home"></i>Home</a>
<a href="{{route('users.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-user"></i>User</a>
<a href="{{route('products.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-box"></i>Product</a>
<a href="{{route('products.barcode')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-barcode"></i>Barcode</a>
<a href="{{route('charts.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-file"></i>Report</a>
<a href="{{route('customers.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-users"></i>Customer</a>
<a href="{{route('suppliers.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-chart-bar"></i>Supplier</a>
@endrole
@role('cashier')
<a href="{{route('home')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-home"></i>Home</a>
<a href="{{route('customers.index')}}" class=" btn btn-outline rounded-pill"><i class=" fa fa-users"></i>Customer</a>
<a href="{{route('orders.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-box fa-lg"></i>ORDERS</a>
@endrole
<style>
    .btn-ouline {
        border-color: #008b8b;
        color: #008b8b;
    }

    .btn-ouline:hover {
        background-color: #008b8b;
        color: #fff;
    }
</style>