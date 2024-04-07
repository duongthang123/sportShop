@extends('admin.layouts.index')

@section('title', 'Thêm người dùng')
@section('content')
    <div class="card-body">
        <h1>Thêm người dùng</h1>

        <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Ảnh người dùng</label>
                        <input type="file" name="image" accept="image/*" id="image-input" class="form-control">

                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <img src="" id="show-image" width="300px"  alt=""/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_name">Tên người dùng </label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="user_name" placeholder="Nhập tên...">

                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="user_email"
                                   placeholder="Nhập email...">
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
                            <input type="text" value="{{ old('phone') }}" name="phone" class="form-control" id="user_phone"
                                   placeholder="Nhập số điện thoại...">
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giới tính</label>
                            <select name="gender" class="form-control">
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
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
                              placeholder="Nhập địa chỉ...">{{ old('address') }}</textarea>
                    @error('address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="user_password">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="user_password"
                           placeholder="Nhập mật khẩu...">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Quyền</label>
                    <div class="row">
                        @foreach($roles as $groupName => $role)
                            <div class="col-4 mt-4">
                                <h5>{{$groupName}}</h5>

                                <div>
                                    @foreach($role as $item)
                                        <div class="form-check">
                                            <input id="customCheck1_{{$item->id}}" class="form-check-input"
                                                   name="roles_id[]" type="checkbox" value="{{$item->id}}">
                                            <label class="form-check-label"
                                                   for="customCheck1_{{$item->id}}">{{$item->display_name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
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
