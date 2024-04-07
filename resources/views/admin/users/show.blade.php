@extends('admin.layouts.index')

@section('title', 'Thông tin người dùng')
@section('content')
    <div class="card-body">
        <h1>Thông tin người dùng</h1>

        <form>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Ảnh người dùng</label>
                        <input disabled type="file" name="image" accept="image/*" id="image-input" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <img src="{{$user->image_path}}" id="show-image" width="300px"  alt=""/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_name">Tên người dùng </label>
                            <input disabled type="text" name="name" value="{{ old('name') ?? $user->name }}" class="form-control" id="user_name" placeholder="Enter your name..">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input disabled type="email" value="{{ old('email') ?? $user->email}}" name="email" class="form-control" id="user_email"
                                   placeholder="Email...">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_phone">Số điện thoại </label>
                            <input type="text" disabled value="{{ old('phone') ?? $user->phone}}" name="phone" class="form-control" id="user_phone"
                                   placeholder="Phone number...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giới tính </label>
                            <select disabled name="gender" class="form-control">
                                <option value="male" {{$user->gender === 'male' ? 'selected' : ''}}>Nam </option>
                                <option value="female" {{$user->gender === 'female' ? 'selected' : ''}}>Nữ </option>
                            </select>
                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <label for="user_address">Địa chỉ </label>
                    <textarea disabled type="text" name="address" class="form-control" id="user_address"
                              placeholder="Address...">{{ old('address') ?? $user->address }}</textarea>
                </div>


                <div class="form-group">
                    <label for="">Quyền </label>
                    <div class="row">
                        @foreach($roles as $groupName => $role)
                            <div class="col-4 mt-4">
                                <h5>{{$groupName}}</h5>

                                <div>
                                    @foreach($role as $item)
                                        <div class="form-check">
                                            <input disabled id="customCheck1_{{$item->id}}" class="form-check-input"
                                                   name="roles_id[]" type="checkbox" value="{{$item->id}}"
                                            {{$user->roles->contains('name', $item->name) ? 'checked' : ''}}
                                            >
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
                <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
            </div>
        </form>
    </div>
@endsection
