@extends('admin.layouts.index')

@section('title', 'Thêm quyền')
@section('content')
    <div class="card-body">
        <h1>Thêm quyền </h1>

        <form action="{{route('roles.store')}}" method="POST">
            @csrf
            <div>
                <div class="form-group">
                    <label for="role_name">Tên quyền</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="role_name" placeholder="Nhập tên quyền">

                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role_display_name">Display Name</label>
                    <input type="text" value="{{ old('display_name') }}" name="display_name" class="form-control" id="role_display_name"
                           placeholder="Password">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Group</label>
                    <select name="group" class="form-control">
                        <option value="system">System</option>
                        <option value="user">User</option>
                    </select>

                    @error('group')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Permission</label>
                    <div class="row">
                        @foreach($permissions as $groupName => $permission)
                            <div class="col-4 mt-4">
                                <h4>{{$groupName}}</h4>

                                <div>
                                    @foreach($permission as $item)
                                        <div class="form-check">
                                            <input id="customCheck1_{{$item->id}}" class="form-check-input"
                                                   name="permissions_id[]" type="checkbox" value="{{$item->id}}">
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
