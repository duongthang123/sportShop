<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_1280.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
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
                <a href="{{route('dashboard')}}" class="nav-link {{request()->routeIs('dashboard') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item  {{request()->routeIs('roles.*') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link {{request()->routeIs('roles.*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>
                        Quyền
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link {{request()->routeIs('roles.index') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách quyền </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('roles.create') }}" class="nav-link {{request()->routeIs('roles.create') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm quyền</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{request()->routeIs('users.*') ? 'menu-open' : ''}}">
                <a href="{{route('users.index')}}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Người dùng
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('users.create')}}" class="nav-link {{ request()->routeIs('users.create') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{request()->routeIs('categories.*') ? 'menu-open' : ''}}">
                <a href="{{route('categories.index')}}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-bars"></i>
                    <p>
                        Danh mục
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.index') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('categories.create')}}" class="nav-link {{ request()->routeIs('categories.create') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{request()->routeIs('products.*') ? 'menu-open' : ''}}">
                <a href="{{route('products.index')}}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : ''}}">
                    <i class="nav-icon fab fa-product-hunt"></i>
                    <p>
                        Sản phẩm
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('products.create')}}" class="nav-link {{ request()->routeIs('products.create') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{request()->routeIs('products.*') ? 'menu-open' : ''}}">
                <a href="{{route('coupons.index')}}" class="nav-link {{ request()->routeIs('coupons.*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-gift"></i>
                    <p>
                        Mã giảm giá
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('coupons.index') }}" class="nav-link {{ request()->routeIs('coupons.index') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('coupons.create')}}" class="nav-link {{ request()->routeIs('coupons.create') ? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
