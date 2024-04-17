<?php

namespace App\Http\Repository\Admin;

use App\Http\Repository\Admin;
use App\Models\Category;
use App\Models\User;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category::latest('id')->paginate(10);
    }

    public function getCategoryForProduct($active = 1)
    {
        return $this->category::where('active', $active)->get();
    }

    public function getCateParent($parentId = 0)
    {
        return $this->category::where(['parent_id' => $parentId, 'active' => 1])->get();
    }

    public function getCategoryById($id)
    {
        return $this->category::where('id', $id)->first();
    }

    public function create($dataCreate)
    {
        return $this->category::create($dataCreate);
    }

    public function destroyCategory($id)
    {
        return $this->category::where('id', $id)->delete();
    }

    public function getAllCategory()
    {
        return $this->category::where('active', 1)->get();
    }


}
