
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="{{asset('client/img/logonewfoot.jpeg')}}" alt=""></a>
                    </div>
                    <p>Đăng nhập ngay để mua sắm được những sản phẩm với ưu đãi tốt nhất!
                        <a href="{{route('coupon')}}" style="color: red">Khuyến mại</a>
                    </p>
                    <p>Địa chỉ: Lương Điền, Cẩm Giàng, Hải Dương
                    </p>
                    <a href="#"><img src="{{asset('client/img/payment.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Cửa hàng</h6>
                    <ul>
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li><a href="{{route('shop')}}">Cửa hàng</a></li>
                        <li><a href="{{route('cart')}}">Giỏ hàng</a></li>
                        <li><a href="{{route('order.list-order')}}">Đơn hàng</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Liên hệ</h6>
                    <ul>
                        <li><a href="{{route('news')}}">Tin tức</a></li>
                        <li><a href="{{route('coupon')}}">Khuyễn mại</a></li>
                        <li><a href="#">Địa chỉ: Lương Điền, Cẩm Giàng, Hải Dương</a ></li>
                        <li><a href="#">SĐT: 0912812671</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>Đánh Giá</h6>
                    <div class="footer__newslatter">
                        <p>Liên hệ với chúng tôi qua email!</p>
                        <form action="#">
                            <input type="text" placeholder="Your email">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        Hãy ủng hộ DTSport Shop nha  <i class="fa fa-heart-o"
                                                                            aria-hidden="true"></i> <a
                            href="https://colorlib.com" target="_blank"></a>
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form action="{{ route('shop.search') }}" class="search-model-form">
            @csrf
            <input type="text" name="key" id="search-input" placeholder="Tim kiếm.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="{{asset('client/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('client/js/bootstrap.min.js')}}"></script>
<script src="{{asset('client/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('client/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('client/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('client/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('client/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('client/js/mixitup.min.js')}}"></script>
<script src="{{asset('client/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('client/js/main.js')}}"></script>

