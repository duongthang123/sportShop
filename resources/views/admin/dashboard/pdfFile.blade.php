<!doctype html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SportShop</title>
    <style>
        *{ font-family: DejaVu Sans !important;}
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>


<style>
    /*css*/
</style>
<br>
<div class="card-body">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p style="margin: 0; padding-top: 8px; font-size: 30px"><b>DTSportShop</b></p>
                    <p style="margin: 0;padding-top: 8px"><b>Địa chỉ:</b> số 32, Lương Xá, Lương Điền, Cẩm Giàng, Hải
                        Dương</p>
                    <p style="margin: 0; padding-top: 8px"><b>Số điện thoại:</b> 0961172512</p>
                </div>
                <div class="col-6 text-right">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p style="text-align: center; margin-top: 18px; font-size: 32px"><b>Thông tin đơn hàng</b></p>
                </div>
            </div>

            <div class="row">
                <div class="col-6">

                    <p style="margin: 0; padding: 4px 0"><b>Mã đơn hàng:</b> {{$order->id}}</p>
                    <p style="margin: 0; padding: 4px 0"><b>Ngày đặt hàng:</b> {{$order->created_at}}</p>
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
                    <p style="margin-top: 18px; font-size: 22px"><b>Danh sách sản phẩm</b></p>

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
                    <p><b>Tổng tiền:</b>
                        @if($order->status_payment == 'Chưa thanh toán')
                            <span style="color: red">{{number_format($order->total)}}</span>

                        @else
                            <span style="color: red">0</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <p><i>Cảm ơn bạn đã mua hàng tại SportShop!</i>

                    </p>
                </div>
            </div>


        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
