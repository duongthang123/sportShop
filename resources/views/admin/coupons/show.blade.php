@extends('admin.layouts.index')

@section('head')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
@endsection


@section('title', 'Thông tin sản phẩm sản phẩm')
@section('content')
    <div class="card-body">
        <h1>Thông tin sản phẩm sản phẩm</h1>

        <form>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                            <input disabled type="text" name="name" value="{{ old('name') ?? $product->name }}"
                                   class="form-control"
                                   id="product_name" placeholder="Nhập tên sản phẩm...">

                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="category_ids[]" disabled multiple class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                        {{$product->categories->contains('id', $category->id) ? 'selected' : ''}}
                                    >
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_ids')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Ảnh sản phẩm</label>
                        <input disabled type="file" name="image" accept="image/*" id="image-input" class="form-control">

                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <img src="{{$product->image_path}}" id="show-image" width="200px" alt=""/>
                    </div>
                </div>

                <div class="row  mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_price">Giá sản phẩm</label>
                            <input disabled type="number" name="price" value="{{ old('price') ?? $product->price }}"
                                   class="form-control"
                                   id="product_price" placeholder="Nhập gía sản phẩm...">

                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_sale">Giá khuyến mại</label>
                            <input disabled type="number" name="sale" value="{{ old('sale') ?? $product->sale }}"
                                   class="form-control"
                                   id="product_sale" placeholder="Nhập gía giảm giá...">

                            @error('sale')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="">Mô tả sản phẩm</label>
                    <textarea disabled name="description" class="form-control" id="description"
                              placeholder="Nhập mô tả chi tiết...">{{$product->description}}</textarea>
                </div>


                <div id="sizeRows">
                    <label for="">Chi tiết sản phẩm</label>

                    @foreach($product['details'] as $key => $productDetail)
                        <div class="row product-size-row-{{$key}} d-flex align-items-center" data-row={{$key}}>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_size">Size</label>
                                    <select disabled name="size[]" class="form-control">
                                        <option value="S" {{$productDetail->size === 'S' ? 'selected' : ''}}>S</option>
                                        <option value="XS" {{$productDetail->size === 'XS' ? 'selected' : ''}}>XS
                                        </option>
                                        <option value="M" {{$productDetail->size === 'M' ? 'selected' : ''}}>M</option>
                                        <option value="L" {{$productDetail->size === 'L' ? 'selected' : ''}}>L</option>
                                        <option value="XL" {{$productDetail->size === 'XL' ? 'selected' : ''}}>XL
                                        </option>
                                        <option value="XXL" {{$productDetail->size === 'XXL' ? 'selected' : ''}}>XXL
                                        </option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Số lượng sản phẩm</label>
                                    <input disabled type="number" name="quantity[]" value="{{$productDetail->quantity}}" min="0"
                                           class="form-control"
                                           placeholder="Nhập số lượng sản phẩm...">
                                </div>
                                @error('quantity')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="product_size">Màu sắc</label>
                                    <input disabled type="color" value="{{$productDetail->color}}" name="color[]"
                                           class="form-control">
                                </div>
                                @error('color')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('size')
                <span class="text-danger">{{$message}}</span>
                @enderror


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_phone">Kích hoạt</label>
                            <div class="custom-control custom-radio">
                                <input disabled class="custom-control-input" value="1" type="radio" id="active" name="active"
                                    {{$product->active === 1 ? 'checked' : ''}}>
                                <label for="active" class="custom-control-label">Có</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input disabled class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                                    {{$product->active === 0 ? 'checked' : ''}}>
                                <label for="no_active" class="custom-control-label">Không</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="{{route('products.index')}}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <script>
        // CKeditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection

