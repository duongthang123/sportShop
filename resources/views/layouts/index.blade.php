<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sport Shop</title>
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
    <style>
        .active-cate {
            color: #000 !important;
        }
    </style>

</head>

<body>
<!-- Page Preloder -->
<div id="preloder" style="display: none;">
    <div class="loader" style="display: none;"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
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
            <p>Xin chào: {{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
            @endguest

        </div>
        <div class="offcanvas__top__hover">
        </div>
    </div>
    <div class="offcanvas__nav__option">
        <a href="#" class="search-switch"><img src="{{asset('client/img/icon/search.png')}}" alt=""></a>
        <a href="{{route('cart')}}"><img src="{{asset('client/img/icon/cart.png')}}" alt=""> </a>
        <div class="price">{{$countProductInCart}}</div>
    </div>
    <div id="mobile-menu-wrap">
        <div class="slicknav_menu">
            <a href="#" aria-haspopup="true" role="button" tabindex="0" class="slicknav_btn slicknav_collapsed" style="outline: none;">
                <span class="slicknav_menutxt">MENU</span>
                <span class="slicknav_icon">
                    <span class="slicknav_icon-bar">

                    </span><span class="slicknav_icon-bar">

                    </span><span class="slicknav_icon-bar"></span></span></a><nav class="slicknav_nav slicknav_hidden" aria-hidden="true" role="menu" style="display: none;">
                <ul>

                    <li>
                        <a  style="text-transform: inherit; font-family: 'Nunito Sans', sans-serif;letter-spacing: 0px" class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav></div></div>
    <div class="offcanvas__text">
        <p>Nhập mã MK01 để được giảm giá 10% đơn hàng</p>
    </div>

</div>
<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7"  style="display: flex; align-items: center">
                    <div class="header__top__left">
                        <p>Đăng nhập để sử dụng những <a style="color: red" href="{{ route('coupon') }}">khuyến mại</a> đặc biệt!</p>
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
                                    <nav class="navbar navbar-expand-lg">
                                        <div class="container-fluid">
                                            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                                <ul class="navbar-nav">
                                                    <li class="nav-item dropdown">
                                                        <a style="text-transform: inherit; font-family: 'Nunito Sans', sans-serif; letter-spacing: 1px" class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Xin chào: {{ \Illuminate\Support\Facades\Auth::user()->name  }}
                                                        </a>
                                                        <ul style="background-color: black; " class="dropdown-menu-lg-start dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                                            <li><a style="text-transform: initial;font-family: 'Nunito Sans', sans-serif;letter-spacing: 0px" class="dropdown-item" href="{{route('user.show', \Illuminate\Support\Facades\Auth::user()->id)}}">Thông tin cá nhân</a></li>
                                                            <li><a style="text-transform: inherit; font-family: 'Nunito Sans', sans-serif;letter-spacing: 0px" class="dropdown-item" href="{{route('order.list-order')}}">Đơn hàng của tôi</a></li>
                                                            <li><a style="text-transform: inherit; font-family: 'Nunito Sans', sans-serif;letter-spacing: 0px" class="dropdown-item" href="{{route('coupon')}}">Mã khuyến mại</a></li>
                                                            <li>
                                                                <a  style="text-transform: inherit; font-family: 'Nunito Sans', sans-serif;letter-spacing: 0px" class="dropdown-item" href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Đăng xuất
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </nav>
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
                <div class="header__logo" style="padding: 20px 0 !important;">
                    <a href="{{route('home')}}"><img src="{{asset('client/img/logonewhead.jpeg')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                @include('layouts.navbar')
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="{{asset('client/img/icon/search.png') }}" alt=""></a>
                    <a href="{{route('cart')}}"><img src="{{asset('client/img/icon/cart.png') }}" alt=""></a>
                    <div class="price">{{$countProductInCart}}</div>
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

@yield('script')
<script>
    var botmanWidget = {
        aboutText: 'Băt đầu bằng lời xin chào',
        introMessage: 'Chào mừng bạn đến với SportShop!',
    }
</script>
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
<script src="{{asset('client/js/product.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
