@extends('admin.layouts.index')

@section('title', 'Quản lý đơn hàng')
@section('content')
    <div class="card-body">
        <h1>Danh sách các đơn hàng</h1>
        <div class="card-body table-responsive p-0">
            <div class="row">
                <div class="col-12 mb-4 mt-2">
                    <form action="{{route('orders.order-filter')}}" method="POST" class="d-flex justify-content-start">
                        @csrf
                        <div class="form-group">
                            <select name="status" class="form-control"
                                    style="cursor: pointer; max-width: 240px">
                                <option selected>Lọc đơn hàng</option>
                                @foreach(config('order.status') as $status)
                                    <option value="{{$status}}">{{$status}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="max-height: 38px; margin-left: 4px">Lọc</button>
                    </form>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th style="width: 50px">&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td> {{$order->id}} </td>
                            <td style="max-width: 200px; word-wrap: break-word; overflow-wrap: break-word"> {{$order->customer_name}} </td>
                            <td> {{$order->customer_phone}} </td>
                            <td> {{ $order->customer_email }} </td>
                            <td style="max-width: 260px; word-wrap: break-word; overflow-wrap: break-word"> {{ $order->customer_address  }} </td>
                            <td> {{ number_format($order->total) }} </td>
                            <td> {{$order->payment}} </td>
                            <td> {{$order->status_payment}} </td>
                            <td>
                                <div class="form-group" style="max-width: 160px; ">
                                    <select name="status" class="form-control select_status"
                                            data-action="{{route('orders.update_status', $order->id)}}"
                                            data-order-id ="{{$order->id}}"
                                            style="cursor: pointer">
                                        @foreach(config('order.status') as $status)
                                            <option value="{{$status}}"
                                            {{$status === $order->status ? 'selected' : ''}}
                                            >{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td> {{ date("d-m-Y / H:i", strtotime($order->created_at)) }} </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $orders->appends(request()->only('key'))->links() }}
    </div>
@endsection
