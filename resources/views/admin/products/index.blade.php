@extends('admin.layouts.index')

@section('title', 'Quản lý sản phẩm')
@section('content')
    <div class="card-body">
        <h1>Sản phẩm</h1>
        <div class="mb-2">
            <a href="{{route('products.create')}}" class="btn btn-primary">Thêm mới</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
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
                        <td> {{ number_format($product->price) }} </td>
                        <td> {{ number_format($product->sale) }} </td>
                        <td> {!! \App\Helpers\Helper::active($product->active) !!} </td>
                        <td> {{$product->updated_at}} </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="removeRow('products/{{$product->id}}')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                @endforeach
            </tbody>
        </table>
        {{ $products->appends(request()->only('key'))->links() }}
    </div>
@endsection
