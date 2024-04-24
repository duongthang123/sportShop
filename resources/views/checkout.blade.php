@extends('layouts.index')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Thanh Toán</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <a href="{{route('cart')}}">Gỉỏ hàng</a>
                            <span>Thanh Toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad" style="padding-top: 50px">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Hãy điền thông tin của bạn để tạo đơn hàng</h6>
                            <h6 class="checkout__title">Chi tiết đơn hàng</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Họ tên khách hàng <span>*</span></p>
                                        <input id="customer_name" type="text" name="customer_name" value="{{  old('customer_name') ?? \Illuminate\Support\Facades\Session::get('customer_name') }}" placeholder="Nhập họ tên bạn..." style="color: black">
                                        @error('customer_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input id="customer_email" type="text" name="customer_email" value="{{ old('customer_email') ?? \Illuminate\Support\Facades\Session::get('customer_email') }}" placeholder="Nhập email..." style="color: black">
                                        @error('customer_email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input id="customer_phone" type="text" name="customer_phone" value="{{ old('customer_phone') ?? \Illuminate\Support\Facades\Session::get('customer_phone') }}" placeholder="Nhập số điện thoại..." style="color: black">
                                @error('customer_phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input id="customer_address" type="text" name="customer_address" value="{{ old('customer_address') ?? \Illuminate\Support\Facades\Session::get('customer_address') }}" placeholder="Nhập địa chỉ của bạn..." class="checkout__input__add" style="color: black">
                                @error('customer_address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú</p>
                                <textarea id="customer_note" name="note" style="width: 100%; color: black">{{ old('note') ?? \Illuminate\Support\Facades\Session::get('note') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Tổng tiền</span></div>
                                <ul class="checkout__total__products">
                                    @php $totalPrice = 0; @endphp
                                    @foreach($carts['products'] as $key => $item)
                                        <li style="display: flex; align-items: center; justify-content: space-between">{{ $key += 1 }}. {{$item->product->name}}
                                            <b>x{{$item->product_quantity}}</b>
                                            <span style="font-weight: 700; margin-left: 18px">
                                                @php $totalProduct = $item->product_price * $item->product_quantity;
                                                        $totalPrice += $totalProduct;
                                                @endphp
                                                {{number_format($totalProduct)}}
                                            </span></li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Tổng phụ <span>{{number_format($totalPrice)}}</span></li>
                                    <li>Ship <span>
                                            @php $shipping = 30000;
                                                $totalPrice += $shipping;
                                            @endphp
                                            {{number_format($shipping)}}
                                        </span></li>
                                    <li>Giảm giá <span>
                                            @if(\Illuminate\Support\Facades\Session::get('coupon_code'))
                                                @php $couponPrice = $totalPrice * \Illuminate\Support\Facades\Session::get('coupon_value') / 100; @endphp
                                                {{number_format($couponPrice)}}
                                            @else
                                                0
                                            @endif
                                        </span></li>
                                    <li>Tổng tiền <span>
                                            @if(\Illuminate\Support\Facades\Session::get('coupon_code'))
                                                @php
                                                    $total = $totalPrice - $couponPrice;
                                                @endphp
                                                {{number_format($total)}}
                                            @else
                                                @php
                                                    $total = $totalPrice;
                                                @endphp
                                                {{number_format($total)}}
                                            @endif

                                        </span>
                                        <input type="hidden" name="total" value="{{$total}}">
                                    </li>
                                </ul>
                                <p style="font-weight: 600; color: black">Lựa chọn hình thức thanh toán</p>
                                <div class="checkout__input__checkbox" style="display: flex; align-items: center;">
                                    <input type="radio" value="offline" name="payment" checked id="payment">
                                    <label for="payment" style="margin: 0; padding-left: 8px"> Thanh toán khi nhận hàng </label>
                                </div>
                                <div class="checkout__input__checkbox" style="display: flex; align-items: center;">
                                    <input type="radio" value="online" name="payment" id="payonline"
                                        @if( isset($_GET['vnp_TransactionStatus']) )
                                            checked
                                        @elseif(isset($_GET['paymentOption']))
                                            checked
                                        @endif
                                    >
                                    <label for="payonline" style="margin: 0; padding-left: 8px"> Thanh toán online </label>
                                </div>
                                <ul class="list-group" id="paymentOptions" style="display:none;">
                                    <li class="list-group-item"  style="display: flex; align-items: center; justify-content: space-between">
                                        <img src="{{asset('client/img/momo.jpg')}}" style="max-width: 40px; border-radius: 4px">

                                        <form action="{{route('order.payment_momo')}}" method="POST">
                                            <button id="momoForm" onclick="collectMomoFormData()" name="redirect" form="momo_form" style="margin-left: 4px; padding: 6px; width: 180px">MOMO</button>
                                        </form>
                                    </li>
                                    <li class="list-group-item" style="display: flex; align-items: center; justify-content: space-between">
                                        <img src="{{asset('client/img/vnpay.jpg')}}" style="max-width: 40px; border-radius: 4px">

                                        <form action="{{route('order.payment_vnpay')}}" method="POST">
                                            <button id="vnpayForm"  onclick="collectFormData()" name="redirect" form="vnpay_form" style="margin-left: 4px; padding: 6px; width: 180px">VNPay</button>
                                        </form>
                                    </li>
                                </ul>
                                @error('payment')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <input type="hidden" value="
                                    @if(isset($_GET['paymentOption']))
                                        {{ $_GET['paymentOption'] }}
                                        @elseif(isset($_GET['vnp_TransactionStatus']))
                                            vnpay
                                        @else
                                        chưa thanh toán
                                   @endif
                                    " name="status_payment">
                                <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="vnpay_form" action="{{route('order.payment_vnpay')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$total}}" name="total">
                    <input type="hidden" id="customer_name_checkout" name="customer_name">
                    <input type="hidden" id="customer_email_checkout" name="customer_email">
                    <input type="hidden" id="customer_phone_checkout" name="customer_phone">
                    <input type="hidden" id="customer_address_checkout" name="customer_address">
                    <input type="hidden" id="note_checkout" name="note">

                </form>
                <form id="momo_form" action="{{route('order.payment_momo')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$total}}" name="total">
                    <input type="hidden" id="customer_name_checkout_momo" name="customer_name">
                    <input type="hidden" id="customer_email_checkout_momo" name="customer_email">
                    <input type="hidden" id="customer_phone_checkout_momo" name="customer_phone">
                    <input type="hidden" id="customer_address_checkout_momo" name="customer_address">
                    <input type="hidden" id="note_checkout_momo" name="note">

                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#payonline').click(function () {
                if($(this).is(':checked')) {
                    $('#paymentOptions').show();
                } else{
                    $('#paymentOptions').hide();
                }
            });
        });

    </script>

    <script>
        function collectFormData() {
            // Lấy dữ liệu từ các ô input của các form khác
            var customerName = document.getElementById('customer_name').value;
            var customerEmail = document.getElementById('customer_email').value;
            var customerPhone = document.getElementById('customer_phone').value;
            var customerAddress = document.getElementById('customer_address').value;
            var note = document.getElementById('customer_note').value;

            // Gán dữ liệu vào các ô input của form thanh toán
            document.getElementById('customer_name_checkout').value = customerName;
            document.getElementById('customer_email_checkout').value = customerEmail;
            document.getElementById('customer_phone_checkout').value = customerPhone;
            document.getElementById('customer_address_checkout').value = customerAddress;
            document.getElementById('note_checkout').value = note;

            // Submit form thanh toán
            document.getElementById('vnpayForm').submit();

        }
            function collectMomoFormData() {

                // Lấy dữ liệu từ các ô input của các form khác
                var customerName = document.getElementById('customer_name').value;
                var customerEmail = document.getElementById('customer_email').value;
                var customerPhone = document.getElementById('customer_phone').value;
                var customerAddress = document.getElementById('customer_address').value;
                var note = document.getElementById('customer_note').value;

                // Gán dữ liệu vào các ô input của form thanh toán
                document.getElementById('customer_name_checkout_momo').value = customerName;
                document.getElementById('customer_email_checkout_momo').value = customerEmail;
                document.getElementById('customer_phone_checkout_momo').value = customerPhone;
                document.getElementById('customer_address_checkout_momo').value = customerAddress;
                document.getElementById('note_checkout_momo').value = note;

                // Submit form thanh toán
                document.getElementById('momoForm').submit();
            }
    </script>
@endsection
