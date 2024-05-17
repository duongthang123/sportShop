@extends('layouts.index')

@section('content')
    <section class="shop-details">
        <div class="product__details__pic" style="margin-bottom: 0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb" style="float: left;">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <a href="{{route('shop')}}">Cửa hàng</a>
                            <span>{{$product->name}}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{$product->image_path}}"
                                         style="background-image: url(&quot;{{$product->image_path}}&quot;); background-position: center; background-size: cover;">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-5 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img style="width: 90%" src="{{ $product->image_path }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-9">
                        <form action="{{route('product.store')}}" method="POST">
                            @csrf
                            <div class="product__details__text text-left">
                                <h4>{{ $product->name }}</h4>
                                <h3 style="color: red">{{$product->sale > 0 ? number_format($product->sale) : number_format($product->price)}}
                                    <span>{{ $product->sale > 0 ? number_format($product->price) : ''}}</span></h3>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="price" value="{{$product->sale > 0 ? $product->sale : $product->price}}">

                                <div class="product__details__option" style="margin-top: 40px">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="size" class="form-control"  id="size">
                                                    <option value="">Chọn Size</option>
                                                    @php $sizes = [] @endphp
                                                    @foreach($product['details'] as $item)
                                                        @if(!in_array($item->size, $sizes))
                                                            <@php $sizes[] = $item->size  @endphp
                                                            <option value="{{$item->size}}">{{ $item->size }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: 12px">
                                            <div class="form-group">
                                                <label>Chọn màu sắc:</label>
                                                <div class="color-options" >
                                                    @foreach($product['details'] as $item)
                                                            <label class="color-option p-2" data-qty="{{$item->quantity}}" data-size="{{$item->size}}">
                                                                <input type="radio" name="color" value="{{$item->color}}">
                                                                <input type="color" disabled value="{{$item->color}}">
                                                            </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <span class="fa fa-angle-up dec qtybtn"></span>
                                            <input type="text" name="quantity" value="1">
                                            <span class="fa fa-angle-down inc qtybtn"></span>
                                        </div>
                                    </div>
                                    <button type="submit" class="primary-btn" style="border-radius: 3px; outline: none; border: none">Mua ngay</button>
                                </div>
                                <div class="product__details__last__option">
                                    <ul>
                                        <li><span>Mã sản phẩm:</span>{{$product->id}}</li>
                                        <li><span>Danh mục:</span>
                                            @foreach ($categories as $category)
                                                {{$category->name}},
                                            @endforeach
                                        </li>
                                        <li><span >Số lượng:</span>
                                            <span style="color: black; font-weight: 700" id="product_qty">
                                            @php
                                                $sum = $product->details->sum('quantity')
                                            @endphp
                                                {{  $sum > 0 ? $sum : 'Đã hết hàng'}}
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Đánh giá </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        {!!  $product->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <h4>Thông tin đánh giá</h4>
                                        <p></p>
                                        <p>Hiện chưa có đánh giá nào!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Sản Phẩm Tương Tự</h3>
                </div>
            </div>
            <div class="row">
                @foreach($productsRelate as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{$product->image_path}}" style="background-image: url(&quot;<?php echo $product->image_path ?>&quot;);">
                                @if($product->sale > 0)
                                    <span style="background: #000; color: #fff" class="label">Sale</span>
                                @endif
                                <ul class="product__hover">
                                    <li><a href="#"><img style="width: 36px" src="{{asset('client/img/icon/add.png')}}" alt=""> <span style="color: #fff">Thêm giỏ hàng</span></a>
                                    </li>
                                    <li><a href="{{ route('product', $product->id) }}"><img src="{{asset('client/img/icon/search.png')}}" alt=""><span style="color: #fff">Xem chi tiết</span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{$product->name}}</h6>
                                <a href="#" class="add-cart">+ Thêm giỏ hàng</a>
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

@section('script')
    <script>
        $(document).ready(function () {
            $('#size').change(function () {
                var selectedSize = $(this).val();
                $('.color-option').hide();
                var quantity = 0;

                $('.color-option').each(function () {
                    if($(this).data('size') === selectedSize) {
                        $(this).show();
                        quantity += parseInt($(this).data('qty'))
                    }
                });
                $('#product_qty').text(quantity > 0 ? quantity : 'Đã hết hàng');
            })
            $('.color-option').hide();
        });
    </script>
@endsection
