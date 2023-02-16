<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-uppercase fw-bold">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{route("admin.index")}}" class="nav-link">
                    <i class="nav-icon fas fa-angle-double-right"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route("admin.category.index")}}" class="nav-link">
                    <i class="nav-icon fas fa-angle-double-right"></i>
                    <p>Category List</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route("admin.blogs.index")}}" class="nav-link">
                    <i class="nav-icon fas fa-angle-double-right"></i>
                    <p>Blog List</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route("admin.clients")}}" class="nav-link">
                    <i class="nav-icon fas fa-angle-double-right"></i>
                    <p>Client List</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route("admin.orders.index")}}" class="nav-link">
                    <i class="nav-icon fas fa-angle-double-right"></i>
                    <p>Order List
                        @if($pending_order)<span class="right badge badge-danger">{{$pending_order}}</span>@endif
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route("admin.users.index")}}" class="nav-link">
                    <i class="nav-icon fas fa-angle-double-right"></i>
                    <p>Admin List</p>
                </a>
            </li>
           

            <li class="nav-item">
                <a href="{{route("admin.roles.index")}}" class="nav-link">
                    <i class="nav-icon fas fa-angle-double-right"></i>
                    <p>Role Permission</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-angle-double-right"></i>
                    <p>Settings</p>
                </a>
            </li>
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>