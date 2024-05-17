@extends('layouts.index')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Về chúng tôi</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <span>Về cửa hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="{{asset('client/img/banner-sport.jpeg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Chúng tôi là ai?</h4>
                        <p>DTSportShop luôn mang lại những mặt hàng có giá trị chất lượng, luôn mang đến cho khách hàng những sự thoải mái trong đam mê thể thao!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Bạn cần trợ giúp?</h4>
                        <p>Hãy liên lạc ngay với chúng tôi nếu bạn cần sự trợ giúp!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Tại sao nên chọn DTSportShop?</h4>
                        <p>DTSportShop luôn mang lại cho khách hàng yên tâm về chất lượng, độ bền của sản phẩm và sự phục vụ nhiệt tình!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Liên hệ với chúng tôi</span>
                        </div>
                        <ul>
                            <li>
                                <h4>Địa chỉ:</h4>
                                <p>Lương Điền - Cẩm Giàng - Hải Dương</p>
                            </li> <li>
                                <h4>Số điện thoại:</h4>
                                <p>098127381261</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Họ tên">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Nội dung ... "></textarea>
                                    <button type="submit" class="site-btn">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

