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
                            <a href="{{ url('buku') }}" class="nav-link {{ request()->is('buku') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Data Buku
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ url('member') }}" class="nav-link {{ request()->is('member') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-solid fa-users"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Data Member
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ url('pengarang') }}" class="nav-link {{ request()->is('pengarang') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-lines-fill"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                     Pengarang
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ url('penerbit') }}" class="nav-link {{ request()->is('penerbit') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-bookmark-star-fill"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Penerbit
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>


                        <li class="nav-item ">
                            <a href="{{ url('katalog') }}" class="nav-link {{ request()->is('katalog') ? 'active' : '' }}">
                                <i class="nav-icon bi-grid"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Katalog
                                    <i class="right fas fa-angle-down"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ url('transaksi') }}" class="nav-link {{ request()->is('transaksi') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-wallet-fill"></i>
                                <!-- <i class="fa-solid fa-book-open-cover"></i> -->
                                <p>
                                    Transaksi
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