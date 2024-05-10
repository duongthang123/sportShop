@extends('admin.layouts.index')

@section('title', 'Quản lý đơn hàng')
@section('content')
    <div class="card-body">
        <h1>Thống kê doanh thu</h1>
        <div class="card-body table-responsive p-0">
            <div class="row">
                <div class="col-6 mb-4 mt-2">
                    <form action="{{route('orders.search')}}" method="POST" class="d-flex justify-content-start">
                        @csrf
                        <div class="form-group">
                            <input type="date" name="key" class="form-control" placeholder="Tìm kiếm đơn hàng">
                        </div>
                        <button type="submit" class="btn btn-primary" style="max-height: 38px; margin-left: 4px">Tìm kiếm</button>
                    </form>
                </div>
                <div class="col-6 mb-4 mt-2">
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
                </tbody>
            </table>
        </div>
    </div>
@endsection
