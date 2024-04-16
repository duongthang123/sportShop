<nav class="header__menu mobile-menu">
    <ul>
        <li class="{{ request()->routeIs('home') ? 'active' : ''}}"><a href="{{ route('home') }}">Trang chủ</a></li>
        <li class="{{ request()->routeIs('shop') ? 'active' : ''}}"><a href="{{route('shop')}}" >Cửa hàng</a></li>
        <li><a href="#">Pages</a>
            <ul class="dropdown">
                <li><a href="./about.html">About Us</a></li>
                <li><a href="./shop-details.html">Shop Details</a></li>
                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                <li><a href="./checkout.html">Check Out</a></li>
                <li><a href="./blog-details.html">Blog Details</a></li>
            </ul>
        </li>
        <li><a href="./blog.html">Tin tức</a></li>
        <li><a href="./contact.html">Liên hệ</a></li>
    </ul>
</nav>
