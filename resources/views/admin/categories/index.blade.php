@extends('admin.layouts.index')

@section('title', 'Roles')
@section('content')
    <div class="card-body">
        <h1>Danh Mục</h1>
        <div class="mb-2">
            <a href="{{route('users.create')}}" class="btn btn-primary">Thêm</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Ảnh</th>
                <th>Tên User </th>
                <th>Email</th>
                <th>Phone</th>
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
