<?php

namespace App\Http\Services\Admin;

use App\Http\Repository\Admin\UserRepository;
use App\Http\Services\Admin;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUser()
    {
        return $this->userRepository->getAllUser();
    }

    public function findUserById($id)
    {
        return $this->userRepository->findUserById($id);
    }

    public function createUser($request)
    {
        $dataCreate = $request->all();
        $dataCreate['password'] = Hash::make($request['password']);
        $dataCreate['image'] = $this->userRepository->saveImage($request);
        if($request->has('roles_id')) {
            $user = $this->userRepository->create($dataCreate);
            $user->roles()->attach($request['roles_id']);
        } else {
            $user = $this->userRepository->create($dataCreate);
        }
        $user->images()->create(['url' => $dataCreate['image']]);
    }

    public function updateUser($request, $id)
    {
        $dataUpdate = $request->except(['password']);
        $user = $this->userRepository->findUserById($id);

        if($request->password) {
            $dataUpdate['password'] = Hash::make($request['password']);
        }

        $currentImage = $user->images->count() > 0 ? $user->images->first()->url : '';
        $dataUpdate['image'] = $this->userRepository->updateImage($request, $currentImage);

        $user->update($dataUpdate);
        $user->images()->delete();
        $user->roles()->sync($request['roles_id'] ?? []);
        $user->images()->create(['url' => $dataUpdate['image']]);
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->findUserById($id);
        $currentImage = $user->images->count() > 0 ? $user->images->first()->url : '';
        if(!empty($currentImage)) {
            $this->userRepository->deleteImage($currentImage);
        }
        $user->images()->delete();
        return $this->userRepository->deleteUser($id);
    }
}
