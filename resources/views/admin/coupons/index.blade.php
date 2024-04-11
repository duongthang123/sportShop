@extends('admin.layouts.index')

@section('title', 'Quản lý mã giảm giá')
@section('content')
    <div class="card-body">
        <h1>Mã giảm giá</h1>
        <div class="mb-2">
            <a href="{{route('coupons.create')}}" class="btn btn-primary">Thêm mới</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Mã giảm giá</th>
                <th>Giá trị</th>
                <th>Ngày hết hạn</th>
                <th>Cập nhật</th>
                <th style="width: 150px">&nbsp;</th>
            </tr>
            </thead>

            <tbody>
                @foreach($coupons as $coupon)
                    <tr>
                        <td> {{$coupon->id}} </td>
                        <td> {{$coupon->name}} </td>
                        <td> {{ $coupon->value}}%</td>
                        <td> {{ $coupon->expery_date }} </td>
                        <td> {{$coupon->updated_at}} </td>
                        <td>
                            <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="removeRow('coupons/{{$coupon->id}}')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                @endforeach
            </tbody>
        </table>
        {{ $coupons->appends(request()->only('key'))->links() }}
    </div>
@endsection
