<?php

namespace App\Http\Repository\Admin;

use App\Http\Repository\Admin;
use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUser()
    {
        return $this->user::latest('id')->paginate(10);
    }

    public function findUserById($id)
    {
        return $this->user::findOrFail($id)->load('roles');
    }

    public function saveImage($request)
    {
        return $this->user->saveImage($request);
    }

    public function updateImage($request, $currentImage)
    {
        return $this->user->updateImage($request, $currentImage);
    }

    public function deleteImage($currentImage)
    {
        return $this->user->deleteImage($currentImage);
    }
    public function create($dataCreate)
    {
        return $this->user->create($dataCreate);
    }

    public function deleteUser($id)
    {
        return $this->user::where('id', $id)->delete();
    }
}
