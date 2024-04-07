<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60"
             width="60">
    </div>

    <!-- Navbar -->
    @include('admin.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="" alt="" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">DT Sports</span>
        </a>

        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper" style="min-height: 770px;">
        <!-- Content -->
        @yield('content')
    </div>

</div>
<!-- /.content-wrapper -->
@include('admin.footer')
</body>
</html>
