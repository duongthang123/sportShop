<?php

namespace App\Http\Repository;

use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserById($id)
    {
        return $this->user::where('id', $id)->first();
    }

    public function findUserById($id)
    {
        return $this->user::where('id', $id)->first();
    }

    public function updateImage($request, $currentImage)
    {
        return $this->user->updateImage($request, $currentImage);
    }

}
