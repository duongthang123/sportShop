<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Services\Admin\RoleService;
use App\Http\Services\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getAllUser();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->getAllRoles();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $this->userService->createUser($request);
        toastr()->success('Create User success');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->findUserById($id);
        $roles = $this->roleService->getAllRoles();
        return view('admin.users.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userService->findUserById($id);
        $roles = $this->roleService->getAllRoles();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $this->userService->updateUser($request, $id);
        toastr()->success('Update User success');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->userService->deleteUser($id);
        if($result) {
            return response()->json([
                'error' => false,
                'message' => 'Delete user success'
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
