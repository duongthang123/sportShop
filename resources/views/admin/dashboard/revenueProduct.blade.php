@extends('admin.layouts.index')

@section('title', 'Thống kê sản phẩm')
@section('content')
    <div class="card-body">
        <h1>Thống kê sản phẩm</h1>
        <div class="card-body table-responsive p-0">
            <div class="row">
                <div class="col-6 mb-4 mt-2">
                    <form action="{{route('dashboard.product-filter')}}" method="POST" class="d-flex justify-content-start">
                        @csrf
                        <div class="form-group">
                            <select name="product_key" class="form-control"
                                    style="cursor: pointer; max-width: 240px">
                                @foreach(config('const.product') as $key => $value)
                                    <option value="{{$key}}"
                                        @if(isset($month)) {{ $month == $key ? 'selected' : '' }} @endif
                                    >{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="max-height: 38px; margin-left: 4px">Lọc</button>
                    </form>
                </div>
            </div>

            @if(isset($products))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng bán</th>
                            <th>Giá gốc</th>
                            <th>Giá giảm</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td> {{$product->id}} </td>
                            <td>
                                <img src="{{$product->image_path}}" width="100px" height="100px">
                            </td>
                            <td> {{$product->name}} </td>
                            <td> {{$product->quantity_sell ? $product->quantity_sell : 0}} </td>
                            <td> {{ number_format($product->price) }} </td>
                            <td> {{ number_format($product->sale) }} </td>
                            <td> {!! \App\Helpers\Helper::active($product->active) !!} </td>
                            <td> {{$product->updated_at}} </td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                    @endforeach
                    </tbody>
                </table>
                {{ $products->appends(request()->only('key'))->links() }}
            @endif
        </div>
    </div>
@endsection
