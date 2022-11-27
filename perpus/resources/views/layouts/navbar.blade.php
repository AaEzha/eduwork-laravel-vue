<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ url('home') }}"
                class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('authors') }}"
                class="nav-link {{ request()->is('authors') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p> Author</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('publishers') }}"
                class="nav-link {{ request()->is('publishers') ? 'active' : '' }}">
                <i class="nav-icon fas fa-newspaper"></i>
                <p> Publisher</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('catalogs') }}"
                class="nav-link {{ request()->is('catalogs') ? 'active' : '' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p> Catalog</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('books') }}"
                class="nav-link {{ request()->is('books') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p> Book</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('members') }}"
                class="nav-link {{ request()->is('members') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p> Member</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('transactions') }}"
                class="nav-link {{ request()->is('transactions') ? 'active' : '' }}">
                <i class="nav-icon fas fa-circle"></i>
                <p> Transaction</p>
            </a>
        </li>
    </ul>
</nav>