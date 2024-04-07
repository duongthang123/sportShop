@extends('admin.layouts.index')

@section('title', 'Quản lý người dùng')
@section('content')
    <div class="card-body">
        <h1>Danh sách người dùng</h1>
        <div class="mb-2">
            <a href="{{route('users.create')}}" class="btn btn-primary">Thêm mới </a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Ảnh</th>
                <th>Tên người dùng </th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th style="width: 150px">&nbsp;</th>
            </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td> {{$user->id}} </td>
                        <td>
                            <img src="{{$user->image_path}}" width="100px" height="100px">
                        </td>
                        <td> {{$user->name}} </td>
                        <td> {{$user->email}} </td>
                        <td> {{$user->phone}} </td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="removeRow('users/{{$user->id}}')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                @endforeach

            </tbody>
        </table>
        {{ $users->appends(request()->only('key'))->links() }}
    </div>
@endsection
