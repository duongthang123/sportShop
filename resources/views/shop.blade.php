@extends('layouts.index')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Cửa hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <span>Cửa hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{ route('shop.search') }}">
                                <input id="keySearch" type="text" name="key" value="{{isset($_GET['key']) ? $_GET['key'] : ''}}" style="color: #000;" placeholder="Tìm kiếm...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll" tabindex="1" style="overflow-y: hidden; outline: none;">
                                                    @foreach($categories as $category)
                                                        <li><a class="{{ request()->is('shop/' . $category->id . '/category') ? 'active-cate' : '' }}" href="{{route('shop.show', $category->id)}}">{{$category->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Lọc theo giá</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a class="filter-by-price" data-price-range="0-200000" href="#">0 - 200.000</a></li>
                                                    <li><a class="filter-by-price" data-price-range="200000-1000000" href="#">200.000 - 1.000.000</a></li>
                                                    <li><a class="filter-by-price" data-price-range="1000000-5000000" href="#">1.000.000 - 5.000.000</a></li>
                                                    <li><a class="filter-by-price" data-price-range="5000000-9999999999" href="#">+ 5.000.000</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Có tất cả {{count($products) }} sản phẩm</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sắp xếp:</p>
                                    <select id="sort-select" style="display: none;">
                                        <option value="">Mặc định</option>
                                        <option value="asc">Giá thấp đến cao</option>
                                        <option value="desc">Giá cao đến thấp</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="product_list_container">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{$product->image_path}}" style="background-image: url(&quot;img/product/product-2.jpg&quot;);">
                                        @if($product->sale > 0)
                                            <span style="background: #000; color: #fff" class="label">Sale</span>
                                        @endif
                                        <ul class="product__hover">
                                            <li><a href="#"><img style="width: 36px" src="{{asset('client/img/icon/add.png')}}" alt=""> <span style="color: #fff">Thêm giỏ hàng</span></a>
                                            </li>
                                            <li><a href="#"><img src="{{asset('client/img/icon/search.png')}}" alt=""><span style="color: #fff">Xem chi tiết</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>{{$product->name}}</h6>
                                        <a href="#" class="add-cart">+ Thêm giỏ hàng</a>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>{{ $product->sale > 0 ? number_format($product->sale) : number_format($product->price) }}</h5>
                                        @if($product->sale > 0)
                                            <del>{{number_format($product->price)}}</del>
                                        @endif
                                        <div class="product__color__select">
                                            <label for="pc-4">
                                                <input type="radio" id="pc-4">
                                            </label>
                                            <label class="active black" for="pc-5">
                                                <input type="radio" id="pc-5">
                                            </label>
                                            <label class="grey" for="pc-6">
                                                <input type="radio" id="pc-6">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $products->appends(request()->only('key'))->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        let debounceTimer;
        $(document).ready(function () {
            // Gọi hàm searchProduct khi giá trị trong ô tìm kiếm hoặc select thay đổi
            $('#keySearch, #selectSearch').on('input', function () {
                // Xóa timeout cũ nếu có
                clearTimeout(debounceTimer);

                // Gọi hàm searchProduct sau 500 milliseconds
                debounceTimer = setTimeout(searchProduct, 5000);
            });
        });

    </script>

@endsection
