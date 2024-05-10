<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/js/app.js'])
    <style>
        .alert-fixed-top-right {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050; /* Sử dụng một giá trị z-index lớn hơn giá trị của modal */
        }
    </style>
    @stack('style')

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
    <aside class="main-sidebar sidebar-dark-primary elevation-4" >
        <!-- Brand Logo -->
        <a href="{{route('dashboard')}}" class="brand-link" style="text-align: center; margin: 0 auto">
            <img src="" alt="" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light" >DTSportShop</span>
        </a>

        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper" style="min-height: 770px;">
        <!-- Content -->
        @yield('content')
    </div>

    <div class="container mt-3">
        <div id="notification" class="alert alert-success alert-dismissible fade alert-fixed-top-right invisible">

        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@include('admin.footer')
@stack('script')

</body>
</html>
