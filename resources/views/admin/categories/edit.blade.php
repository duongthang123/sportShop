@extends('admin.layouts.index')

@section('title', 'Edit User')
@section('content')
    <div class="card-body">
        <h1>Edit User</h1>

        <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Image</label>
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
                            <label for="user_name">Name</label>
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
                            <label for="user_phone">Phone</label>
                            <input type="text" value="{{ old('phone') ?? $user->phone}}" name="phone" class="form-control" id="user_phone"
                                   placeholder="Phone number...">
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="male" {{$user->gender === 'male' ? 'selected' : ''}}>Male</option>
                                <option value="female" {{$user->gender === 'female' ? 'selected' : ''}}>FeMale</option>
                            </select>

                            @error('group')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <label for="user_address">Address</label>
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


                <div class="form-group">
                    <label for="">Roles</label>
                    <div class="row">
                        @foreach($roles as $groupName => $role)
                            <div class="col-4 mt-4">
                                <h5>{{$groupName}}</h5>

                                <div>
                                    @foreach($role as $item)
                                        <div class="form-check">
                                            <input id="customCheck1_{{$item->id}}" class="form-check-input"
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
