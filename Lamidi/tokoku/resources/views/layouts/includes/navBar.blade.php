<a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class=" btn btn-outline rounded-pill"><i class="fa fa-list"></i></a>
<a href="{{route('users.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-user"></i>User</a>
<a href="{{route('products.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-box"></i>Product</a>
<a href="{{route('orders.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-laptop"></i>Cashier</a>
<a href="" class=" btn btn-outline rounded-pill"><i class="fa fa-file"></i>Report</a>
<a href="{{route('transactions.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-money-bill"></i>Transaction</a>
<a href="" class=" btn btn-outline rounded-pill"><i class="fa fa-users"></i>Customer</a>
<a href="{{route('suppliers.index')}}" class=" btn btn-outline rounded-pill"><i class="fa fa-chart-bar"></i>Supplier</a>
<a href="" class=" btn btn-outline rounded-pill"><i class="fa fa-truck"></i>Incoming</a>

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