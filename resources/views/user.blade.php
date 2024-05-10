@extends('layouts.index')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Thông tin người dùng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <span>Thông tin người dùng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
                <form action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Chọn ảnh mới</label>
                                <input type="file" name="image" accept="image/*" id="image-input" class="form-control">

                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <img src="{{$user->image_path}}" id="show-image" width="300px"  alt=""/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_name">Tên người dùng</label>
                                    <input type="text" name="name" value="{{ old('name') ?? $user->name }}" class="form-control" id="user_name" placeholder="Enter your name..">

                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_email">Email</label>
                                    <input type="email" value="{{ old('email') ?? $user->email}}" name="email" class="form-control" id="user_email"
                                           placeholder="Email...">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_phone">Số điện thoại</label>
                                    <input type="text" value="{{ old('phone') ?? $user->phone}}" name="phone" class="form-control" id="user_phone"
                                           placeholder="Phone number...">
                                    @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p style="margin-bottom: 4px">Giới tính</p>
                                    <select name="gender" class="form-control">
                                        <option value="male" {{$user->gender === 'male' ? 'selected' : ''}}>Nam</option>
                                        <option value="female" {{$user->gender === 'female' ? 'selected' : ''}}>Nữ</option>
                                    </select>

                                    @error('group')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="user_address">Địa chỉ</label>
                            <textarea type="text" name="address" class="form-control" id="user_address"
                                      placeholder="Address...">{{ old('address') ?? $user->address }}</textarea>
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" name="password" class="form-control" id="user_password"
                                   placeholder="Password...">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <a href="{{route('home')}}" class="btn btn-danger">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(() => {
            function readURL(input) {
                if(input.files && input.files[0]) {
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
@endsection
