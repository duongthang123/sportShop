@extends('admin.layouts.index')


@section('title', 'Cập nhật mã giảm giá')
@section('content')
    <div class="card-body">
        <h1>Cập nhật mã giảm giá</h1>

        <form action="{{route('coupons.update', $coupon->id)}}" method="POST">
            @csrf
            @method('put')
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_name">Mã giảm giá</label>
                            <input type="text" name="name" value="{{ old('name') ?? $coupon->name}}" class="form-control"
                                   id="product_name" placeholder="Nhập mã giảm gía...">

                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_name">Giá trị</label>
                            <input type="number" name="value" value="{{ old('value') ?? $coupon->value }}" class="form-control"
                                   id="product_name" placeholder="Nhập giá trị mã giảm giá...">

                            @error('value')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row  mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_price">Ngày hết hạn</label>
                            <input type="date" name="expery_date" value="{{ $coupon->expery_date }}" class="form-control"
                                   id="product_price" placeholder="Nhập gía sản phẩm...">

                            @error('expery_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
@endsection
