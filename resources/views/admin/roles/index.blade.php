@extends('admin.layouts.index')

@section('title', 'Quản lý quyền')
@section('content')
    <div class="card-body">
        <h1>Danh sách Quyền</h1>
        <div class="mb-2">
            <a href="{{route('roles.create')}}" class="btn btn-primary">Thêm mới</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Tên quyền </th>
                <th>Tên quyền hiển thị </th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
            </thead>

            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td> {{$role->id}} </td>
                        <td> {{$role->name}} </td>
                        <td> {{$role->display_name}} </td>
                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="removeRow('roles/{{$role->id}}')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                @endforeach

            </tbody>
        </table>
        {{ $roles->appends(request()->only('key'))->links() }}
    </div>
@endsection
