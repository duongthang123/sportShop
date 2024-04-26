<?php

namespace App\Http\Services;

use App\Http\Repository\ProductRepository;
use App\Http\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function updateUserById($request, $id)
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
        $user->roles()->sync($request['roles_id'] ?? 5);
        $user->images()->create(['url' => $dataUpdate['image']]);
    }

}
