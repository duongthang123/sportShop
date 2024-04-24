@extends('layouts.index')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <a href="{{route('shop')}}">Cửa hàng</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th style="text-align: center">Size</th>
                                    <th>Màu sắc</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $totalSum = 0; @endphp
                                @foreach($carts['products'] as $item)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img style="max-width: 60px" src="{{$item->product->image_path}}" alt="">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6 style="cursor: pointer" onclick="location.href='{{route('product', $item->product_id)}}'">{{$item->product->name}}</h6>
                                                <h5>{{number_format($item->product_price)}}</h5>
                                            </div>
                                        </td>
                                        <td class="cart__price" style="text-align: center">
                                            <span style="font-weight: 600; padding: 6px">{{$item->product_size}}</span>
                                        </td>
                                        <td class="cart__price">
                                            <input type="color" disabled style="max-width: 30px" value="{{$item->product_color}}">
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <span class="fa fa-angle-left dec qtybtn"></span>
                                                    <input type="text" value="{{$item->product_quantity}}"
                                                           data-product-id="{{$item->product_id}}"
                                                           data-product-size="{{$item->product_size}}"
                                                           data-product-color="{{$item->product_color}}"
                                                           data-cart-id="{{$carts->id}}"
                                                           class="product-quantity-input">
                                                    <span class="fa fa-angle-right inc qtybtn"></span></div>
                                            </div>
                                        </td>
                                        <td class="cart__price">
                                            @php
                                                $productSum = $item->product_price * $item->product_quantity;
                                                $totalSum += $productSum;
                                            @endphp
                                            {{number_format($productSum)}}
                                        </td>

                                        <td class="cart__close">
                                            <i class="fa fa-close delete-btn-cart" style="cursor: pointer"
                                                                    data-product-id="{{$item->product_id}}"
                                                                    data-product-size="{{$item->product_size}}"
                                                                    data-product-color="{{$item->product_color}}"

                                            ></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{route('shop')}}">Tiếp tục mua hàng</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Cập nhật</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Mã giảm giá</h6>
                        <form action="{{route('cart.apply-coupon')}}" method="POST">
                            @csrf
                            <input type="text" name="coupon" value="{{\Illuminate\Support\Facades\Session::get('coupon_code')}}"
                                   style="color: black"
                                   placeholder="Mã giảm giá">
                            <button type="submit">Áp dụng</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Tổng giỏ hàng</h6>
                        <ul>

                            <li>Tổng phụ <span>
                                    {{number_format($totalSum)}}

                                </span></li>
                            <li>Phí ship <span>
                                    @php $ship = 30000;
                                            $totalSum += $ship;
                                    @endphp
                                    {{number_format($ship)}}</span></li>
                            <li>Giảm giá<span>
                                    @if(\Illuminate\Support\Facades\Session::get('coupon_code'))
                                        @php $couponPrice = $totalSum * \Illuminate\Support\Facades\Session::get('coupon_value') / 100;
                                        @endphp

                                        {{number_format($couponPrice)}}
                                    @else

                                        {{ 0 }}
                                    @endif
                                </span></li>
                            <li>Tổng tiền <span>
                                    @if(\Illuminate\Support\Facades\Session::get('coupon_code'))
                                        @php $totalSum -= $couponPrice @endphp
                                        {{number_format($totalSum)}}
                                    @else
                                        {{number_format($totalSum)}}
                                    @endif
                                </span></li>
                        </ul>
                        <a href="{{route('checkout')}}" class="primary-btn">Thanh Toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

