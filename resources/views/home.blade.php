@extends('layouts.index')

@section('content')
    @include('layouts.slider')
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li data-filter=".new-arrivals" class="active mixitup-control-active">Mới Nhất</li>
                        <li data-filter=".hot-sales" class="">Giảm Giá</li>
                        <li class="" data-filter="*">Nổi Bật</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter" id="MixItUpCBFFE0" style="">
                @foreach($productNews as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals" style="">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{$product->image_path}}" style="background-image: url(&quot;img/product/product-2.jpg&quot;);">
                                @if($product->sale > 0)
                                    <span style="background: #000; color: #fff" class="label">Sale</span>
                                @endif
                                <ul class="product__hover">
                                    <li>
                                        <a href="#">
                                            <img style="width: 36px" src="{{asset('client/img/icon/add.png')}}" alt="">
                                            <span style="color: #fff">Thêm giỏ hàng</span>
                                        </a>
                                    </li>
                                    <li><a href="{{ route('product', $product->id) }}"><img src="{{asset('client/img/icon/search.png')}}" alt=""><span style="color: #fff">Xem chi tiết</span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{$product->name}}</h6>
                                <a href="{{route('product', $product->id)}}" class="add-cart">Mua ngay</a>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>{{ $product->sale > 0 ? number_format($product->sale) : number_format($product->price) }}</h5>
                                @if($product->sale > 0)
                                    <del>{{number_format($product->price)}}</del>
                                @endif
                                <div class="product__color__select">
                                    <label for="pc-4">
                                        <input type="radio" id="pc-4">
                                    </label>
                                    <label class="active black" for="pc-5">
                                        <input type="radio" id="pc-5">
                                    </label>
                                    <label class="grey" for="pc-6">
                                        <input type="radio" id="pc-6">
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
                @foreach($productSales as $product)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales" style="">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{$product->image_path}}" style="background-image: url(&quot;img/product/product-2.jpg&quot;);">
                                    @if($product->sale > 0)
                                        <span style="background: #000; color: #fff" class="label">Sale</span>
                                    @endif
                                    <ul class="product__hover">
                                        <li>
                                            <a href="#">
                                                <img style="width: 36px" src="{{asset('client/img/icon/add.png')}}" alt="">
                                                <span style="color: #fff">Thêm giỏ hàng</span>
                                            </a>
                                        </li>
                                        <li><a href="{{ route('product', $product->id) }}"><img src="{{asset('client/img/icon/search.png')}}" alt=""><span style="color: #fff">Xem chi tiết</span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{$product->name}}</h6>
                                    <a href="{{route('product', $product->id)}}" class="add-cart">Mua ngay</a>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>{{ $product->sale > 0 ? number_format($product->sale) : number_format($product->price) }}</h5>
                                    @if($product->sale > 0)
                                        <del>{{number_format($product->price)}}</del>
                                    @endif
                                    <div class="product__color__select">
                                        <label for="pc-4">
                                            <input type="radio" id="pc-4">
                                        </label>
                                        <label class="active black" for="pc-5">
                                            <input type="radio" id="pc-5">
                                        </label>
                                        <label class="grey" for="pc-6">
                                            <input type="radio" id="pc-6">
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
