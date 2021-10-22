    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('assets/blanjaloka/img/blanjaloka.png') }}" alt="AdminLTELogo">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('/') }}" target="_BLANK" class="nav-link">Lihat Web</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('admin') }}" class="brand-link">
            <img src="{{ asset('assets/blanjaloka/img/blanjaloka-white.png') }}" alt="AdminLTE Logo"
                class="brand-image" style="opacity: .8">
            <span class="brand-text font-weight-light text-bold"><b>Admin</b></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('assets/blanjaloka/img/avatar.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Rizal Pratama</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ url('admin') }}"
                            class="nav-link {{ $sidebar === 'Dashboard' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    @if ($sidebar == 'Pengelola Pasar' || $sidebar == 'Data Pasar')
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                            @else
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                    @endif
                    <i class="fas fa-house-user nav-icon"></i>
                    <p>
                        Modul Pasar
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/pasar/pengelola') }}"
                                class="nav-link {{ $sidebar === 'Pengelola Pasar' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengelola Pasar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/pasar') }}"
                                class="nav-link {{ $sidebar === 'Data Pasar' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pasar</p>
                            </a>
                        </li>
                    </ul>
                    </li>

                    @if ($sidebar == 'Data Customers' || $sidebar == 'Data Sellers' || $sidebar == 'Data Driver' || $sidebar == 'Data Pemda')
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                            @else
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                    @endif
                    <i class="fas fa-users nav-icon"></i>
                    <p>
                        Modul Users
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/users/customers') }}"
                                class="nav-link {{ $sidebar === 'Data Customers' ? 'active' : '' }}">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/users/sellers') }}"
                                class="nav-link {{ $sidebar === 'Data Sellers' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sellers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/users/pemda') }}"
                                class="nav-link {{ $sidebar === 'Data Pemda' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pemda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/users/driver') }}"
                                class="nav-link {{ $sidebar === 'Data Driver' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Driver</p>
                            </a>
                        </li>
                    </ul>
                    </li>

                    @if ($sidebar == 'Data Toko' || $sidebar == 'Kategori Toko')
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                            @else
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                    @endif
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Modul Toko
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/toko/kategori') }}"
                                class="nav-link {{ $sidebar === 'Kategori Toko' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Toko</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/toko') }}"
                                class="nav-link {{ $sidebar === 'Data Toko' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Toko</p>
                            </a>
                        </li>
                    </ul>
                    </li>

                    @if ($sidebar == 'Kategori Produk')
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <a href="#" class="nav-link active">
                                @else
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                    @endif
                    <i class="fas fa-shopping-bag nav-icon"></i>
                    <p>
                        Modul Produk
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link {{ $sidebar === 'Kategori Produk' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Produk</p>
                            </a>
                        </li>
                    </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('logout') }}" class="nav-link">
                            <i class="fas fa-door-open nav-icon"></i>
                            <p>
                                Keluar
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
