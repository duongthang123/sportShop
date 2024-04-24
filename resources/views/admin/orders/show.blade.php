@extends('admin.layouts.index')


@section('title', 'Thông tin đơn hàng')
@section('content')
    <div class="card-body">
        <h1>Thông tin chi tiết đơn hàng</h1>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <img style="margin-bottom: 6px" src="{{asset('client/img/logo.png')}}">
                        <p style="margin: 0;padding-top: 8px"><b>Địa chỉ:</b> số 32, Lương Xá, Lương Điền, Cẩm Giàng, Hải Dương</p>
                        <p style="margin: 0; padding-top: 8px"><b>Số điện thoại:</b> 0961172512</p>
                    </div>
                    <div class="col-6 text-right">
                        <p><b>Mã đơn hàng:</b> {{$order->id}}</p>
                        <p><b>Ngày đặt hàng:</b> {{$order->created_at}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3 style="font-weight: 600;text-align: center; margin-top: 18px">Thông tin đơn hàng</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <p style="margin: 0; padding: 4px 0"><b>Họ tên khách hàng:</b> {{$order->customer_name}}</p>
                        <p style="margin: 0; padding: 4px 0"><b>Số điện thoại:</b> {{$order->customer_phone}}</p>
                        <p style="margin: 0; padding: 4px 0"><b>Địa chỉ:</b> {{$order->customer_address}}</p>
                        <p style="margin: 0; padding: 4px 0"><b>Ghi chú:</b> {{$order->note}}</p>
                        <p style="margin: 0; padding: 4px 0"><b>Hình thức thanh toán:</b>
                            @if($order->payment == 'offline')
                                Thanh toán khi nhận hàng
                            @else
                                Online qua ví -  {{ $order->status_payment }} - (Đã thanh toán)
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <h5 style="font-weight: 600; margin-top: 20px">Danh sách sản phẩm</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>

                            <tbody>
                            @php $stt = 1; @endphp
                            @foreach($order['products'] as $product)
                                <tr>
                                    <td> {{$stt}} </td>
                                    <td> {{$product->product->name}} </td>
                                    <td> {{ $product->product_size }} </td>
                                    <td> {{ $product->product_quantity }} </td>
                                @php $stt += 1; @endphp
                              @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <p ><b>Tổng tiền:</b>
                            @if($order->status_payment == 'Chưa thanh toán')
                                <span style="color: red">{{number_format($order->total)}}</span>

                            @else
                                <span style="color: red">0</span>
                            @endif
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-footer">
            <div class="row">
                <div class="col-6">
                    <a href="{{route('orders.order_pdf', $order->id)}}" class="btn btn-primary">Xuất Hóa Đơn</a>
                </div>
            </div>
        </div>
    </div>
@endsection
