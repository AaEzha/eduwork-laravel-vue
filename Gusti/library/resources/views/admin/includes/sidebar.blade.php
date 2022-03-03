        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-danger elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset ('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Reading Room</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset ('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth ()->user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="{{ url ('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dasboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ url('books') }}" class="nav-link {{ request()->is('books') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Book
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ url('members') }}" class="nav-link {{ request()->is('members') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-users"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Member
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ url('authors') }}" class="nav-link {{ request()->is('authors') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-lines-fill"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                     Author
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ url('publishers') }}" class="nav-link {{ request()->is('publishers') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-bookmark-star-fill"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Publisher
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>


                        <li class="nav-item ">
                            <a href="{{ url('catalogs') }}" class="nav-link {{ request()->is('catalogs') ? 'active' : '' }}">
                                <i class="nav-icon bi-grid"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Catalog
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ url('transactions') }}" class="nav-link {{ request()->is('transactions') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-wallet-fill"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Transaction
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>