<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male-Fashion | Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('client/css/bootstrap.min.css')}} " type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/style.css')}}" type="text/css">

</head>

<body>
<!-- Page Preloder -->
<div id="preloder" style="display: none;">
    <div class="loader" style="display: none;"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Tạo tài khoản để nhận được những khuyến mãi đặc biệt!</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links" >
                            @guest
                                @if(\Illuminate\Support\Facades\Route::has('login'))
                                    <a href="{{route('login')}}" style="text-transform: inherit">
                                        Đăng nhập
                                    </a>
                                @endif
                                @if(\Illuminate\Support\Facades\Route::has('register'))
                                    <a href="{{route('register')}}" style="text-transform: inherit">Đăng ký</a>
                                @endif

                            @else
                                <div style="text-transform: inherit; color: #fff">
                                    Xin chào: {{ \Illuminate\Support\Facades\Auth::user()->name  }}

                                    <a  style="text-transform: inherit" class="ml-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        | Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{route('home')}}"><img src="{{asset('client/img/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                @include('layouts.navbar')
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="{{asset('client/img/icon/search.png') }}" alt=""></a>
                    <a href="#"><img src="{{asset('client/img/icon/heart.png') }}" alt=""></a>
                    <a href="#"><img src="{{asset('client/img/icon/cart.png') }}" alt=""> <span>0</span></a>
                    <div class="price">$0.00</div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
@yield('content')
<!-- Footer Section Begin -->
@include('layouts.footer')
</body>
</html>
