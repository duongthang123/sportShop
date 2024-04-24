@extends('layouts.index')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Đơn hàng của bạn</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <a href="{{route('cart')}}">Gỉỏ hàng</a>
                            <span>Đơn hàng của bạn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="max-width: 80px">Mã đơn</th>
                                    <th >Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Tổng tiền</th>
                                    <th>Hình thức</th>
                                    <th>Thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td style="max-width: 160px; word-wrap: break-word; overflow-wrap: break-word">
                                            {{$order->customer_name}}</td>
                                        <td>{{ $order->customer_phone }}</td>
                                        <td>{{ number_format($order->total) }}</td>
                                        <td>{{ $order->payment }}</td>
                                        <td>{{ $order->status_payment }}</td>
                                        <td @if($order->status == 'Đã hủy') style="color:red;" @endif>
                                            {{ $order->status }}
                                        </td>
                                        <td>
                                            {{ date("d-m-Y / H:i", strtotime($order->created_at)) }}
                                        </td>
                                        <td style="max-width: 120px; ">
                                            @if($order->status == 'Đợi duyệt')
                                                @php
                                                    $orderAt = strtotime($order->created_at);
                                                   $currentTime = time();
                                                   $timeCancel = ($currentTime - $orderAt) / (60 * 60);
                                                @endphp

                                                @if($timeCancel < 2)
                                                    <form action="{{route('order.cancel-order', $order->id)}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Hủy đơn</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{route('shop')}}">Tiếp tục mua hàng</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
