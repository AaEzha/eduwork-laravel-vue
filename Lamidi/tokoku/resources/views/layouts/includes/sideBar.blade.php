<nav class="active" id="sidebar">
    <ul class="list-unstyled lead">
        @can('admin page')
        <li>
            <a href="{{route('home')}}"><i class="fa fa-home"></i>HOME</a>
        </li>
        <li>
            <a href="{{route('users.index')}}"><i class="fa fa-user"></i>USER</a>
        </li>
        <li>
            <a href="{{route('products.index')}}"><i class="fa fa-box"></i>PRODUCT</a>
        </li>
        <li>
            <a href="{{route('products.barcode')}}"><i class="fa fa-barcode"></i>BARCODE</a>
        </li>
        <li>
            <a href="{{route('charts.index')}}"><i class="fa fa-file"></i>Report</a>
        </li>
        <li>
            <a href="{{route('customers.index')}}"><i class="fa fa-users"></i>Customer</a>
        </li>
        <li>
            <a href="{{route('suppliers.index')}}"><i class="fa fa-chart-bar"></i>Supplier</a>
        </li>
        @endcan
        @role('cashier')
        <li>
            <a href="{{route('home')}}"><i class="fa fa-home"></i>HOME</a>
        </li>
        <li>
            <a href="{{route('customers.index')}}"><i class="fa fa-users"></i>Customer</a>
        </li>
        <li>
            <a href="{{route('orders.index')}}"><i class="fa fa-box fa-lg"></i>ORDERS</a>
        </li>
        @endrole
    </ul>
</nav>

<style>
    #sidebar ul.lead {
        border-bottom: 1px solid #47748b;
        width: fit-content;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.ch;
        display: block;
        width: 30vh;
        color: #008b8b;
    }

    #sidebar ul li a:hover {
        color: #fff;
        background: #008b8b;
        text-decoration: none !important;
    }

    #sidebar ul li a i {
        margin-right: 10px;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #fff;
        background: #008b8b;
    }
</style>