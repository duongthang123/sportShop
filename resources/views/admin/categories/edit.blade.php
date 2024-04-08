@extends('admin.layouts.index')

@section('title', 'Chỉnh sửa danh mục')
@section('content')
    <div class="card-body">
        <h1>Chỉnh sửa danh mục</h1>

        <form action="{{route('categories.update', $category->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cate_name">Tên danh mục</label>
                            <input type="text" name="name" value="{{ old('name') ?? $category->name }}" class="form-control" id="cate_name" placeholder="Nhập tên danh mục...">

                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="parent_id" class="form-control">
                                <option value="0" {{$category->parent_id === 0 ? 'selected' : ''}}>Danh mục cha </option>
                                @foreach($categories as $categoryParent)
                                    <option value="{{$categoryParent->id}}"
                                        {{$category->parent_id === $categoryParent->id ? 'selected' : ''}}
                                    >{{$categoryParent->name}}</option>
                                @endforeach
                            </select>

                            @error('parent_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_phone">Kích hoạt</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                                       {{$category->active === 1 ? 'checked' : ''}}>
                                <label for="active" class="custom-control-label">Có</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                                    {{$category->active === 0 ? 'checked' : ''}}>
                                <label for="no_active" class="custom-control-label">Không</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection

