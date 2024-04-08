@extends('admin.layouts.index')

@section('title', 'Quản lý danh mục')
@section('content')
    <div class="card-body">
        <h1>Danh Mục</h1>
        <div class="mb-2">
            <a href="{{route('categories.create')}}" class="btn btn-primary">Thêm mới</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
                <th style="width: 150px">&nbsp;</th>
            </tr>
            </thead>

            <tbody>
                {!! \App\Helpers\Helper::categories($categories) !!}

            </tbody>
        </table>
        {{ $categories->appends(request()->only('key'))->links() }}
    </div>
@endsection
