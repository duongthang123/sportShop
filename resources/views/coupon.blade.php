@extends('layouts.index')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Mã giảm giá HOT</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <span>Mã giảm giá HOT</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                @php $now =  now();
                    $dateNow = $now->format('Y-m-d');
                @endphp
                @foreach($coupons as $item)

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="{{asset('client/img/coupon.png')}}"
                                 style="background-image: url(&quot;{{asset('client/img/coupon.png')}}&quot;);">
                                <span style="position: absolute;border: 1px solid #ddd ; top: 10px;left: 10px; color: red;font-size: 18px;font-weight: 700;background-color: #ffffff;padding: 5px 10px;border-radius: 5px;" class="coupon-value">
                                    {{ $item->value }}%
                                </span>
                            </div>
                            <div class="blog__item__text">
                                <span>
                                    @if(date('Y-m-d',strtotime($item->expery_date)) < $dateNow)
                                        Đã hết hạn sử dụng !
                                    @else
                                        Có hiệu lực đến: {{ date('d-m-Y',strtotime($item->expery_date)) }}
                                    @endif

                                </span>
                                <h5>Nhập ngay "{{ $item->name }}" để có thể áp dụng khuyến mại!</h5>
                                <p style="color: red">Giảm <b style="font-size: 22px">{{ $item->value }}%</b> cho mỗi
                                    đơn hàng!</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endsection
