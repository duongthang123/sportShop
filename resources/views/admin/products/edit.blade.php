@extends('admin.layouts.index')

@section('head')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
@endsection


@section('title', 'Cập nhật sản phẩm')
@section('content')
    <div class="card-body">
        <h1>Cập nhật sản phẩm</h1>

        <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                            <input type="text" name="name" value="{{ old('name') ?? $product->name }}"
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
                            <select name="category_ids[]" multiple class="form-control">
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
                        <input type="file" name="image" accept="image/*" id="image-input" class="form-control">

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
                            <input type="number" name="price" value="{{ old('price') ?? $product->price }}"
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
                            <input type="number" name="sale" value="{{ old('sale') ?? $product->sale }}"
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
                    <textarea name="description" class="form-control" id="description"
                              placeholder="Nhập mô tả chi tiết...">{{$product->description}}</textarea>
                </div>


                <div class="row">
                    <div class="col-md-6 mb-2">
                        <button type="button" id="addSizeBtn" class="btn btn-success">Thêm size</button>
                    </div>
                </div>

                <div id="sizeRows">
                    @foreach($product['details'] as $key => $productDetail)
                        <div class="row product-size-row-{{$key}} d-flex align-items-center" data-row={{$key}}>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="product_size">Size</label>
                                    <select name="size[]" class="form-control">
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
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Số lượng sản phẩm</label>
                                    <input type="number" name="quantity[]" value="{{$productDetail->quantity}}" min="0"
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
                                    <input type="color" value="{{$productDetail->color}}" name="color[]"
                                           class="form-control">
                                </div>
                                @error('color')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-1" style="margin-top: 16px">
                                <a onclick="removeRow('/productDetails/{{$productDetail->id}}')" class="btn btn-danger"
                                   data-row="{{$key}}" id="deleteSizeBtn">Xóa
                                </a>
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
                                <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                                    {{$product->active === 1 ? 'checked' : ''}}>
                                <label for="active" class="custom-control-label">Có</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                                    {{$product->active === 0 ? 'checked' : ''}}>
                                <label for="no_active" class="custom-control-label">Không</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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

    <script>
        // Preview Image
        $(() => {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var render = new FileReader();
                    render.onload = function (e) {
                        $('#show-image').attr('src', e.target.result);
                        console.log(input.files[0].name);
                    };
                    render.readAsDataURL(input.files[0]);
                }
            }

            $('#image-input').change(function () {
                readURL(this);
            });
        });
    </script>

    <script>
        // Add size with quantity
        document.addEventListener('DOMContentLoaded', function () {
            var addSizeBtn = document.getElementById('addSizeBtn');
            var sizeRows = document.getElementById('sizeRows');
            var lastCurrentSizeRows = sizeRows.lastElementChild;
            var rowCount = lastCurrentSizeRows.getAttribute('data-row');

            addSizeBtn.addEventListener('click', function () {
                rowCount++;

                var newRowHtml = `
                    <div class="row product-size-row-${rowCount} d-flex align-items-center" data-row=${rowCount}>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="product_size">Size</label>
                                <select name="size[]" class="form-control">
                                    <option value="S">S</option>
                                    <option value="XS">XS</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Số lượng sản phẩm</label>
                                <input type="number" name="quantity[]" value="0" min="0" class="form-control" placeholder="Nhập số lượng sản phẩm...">
                            </div>
                            @error('quantity')
                <span class="text-danger">{{$message}}</span>
                            @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="product_size">Màu sắc</label>
                        <input type="color" name="color[]" class="form-control">
                    </div>
                            @error('color')
                <span class="text-danger">{{$message}}</span>
                            @enderror
                </div>
                <div class="col-md-1" style="margin-top: 16px">
                    <button type="button" class="btn btn-danger" data-row-count="${rowCount}" id="deleteSizeBtn">Xóa</button>
                        </div>
                    </div>
                `;


                var newRow = document.createRange().createContextualFragment(newRowHtml);

                sizeRows.appendChild(newRow);
            });
            // Remove size with quantity
            sizeRows.addEventListener('click', function (event) {
                var target = event.target;
                var targetValue = target.getAttribute('data-row-count');
                var test = document.querySelector('.product-size-row-' + targetValue);
                if (test) {
                    sizeRows.removeChild(test)
                }
            });
        });


    </script>

@endsection

