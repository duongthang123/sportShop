<?php

namespace App\Http\Services\Admin;

use App\Http\Repository\Admin\CategoryRepository;
use App\Http\Repository\Admin\UserRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function getCategoryForProduct()
    {
        return $this->categoryRepository->getCategoryForProduct();
    }

    public function getCateParent()
    {
        return $this->categoryRepository->getCateParent();
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    public function updateCategory($request, $id)
    {
        $dataUpdate = $request->all();
        $category = $this->categoryRepository->getCategoryById($id);
        return $category->update($dataUpdate);
    }
    public function createCategory($request)
    {
        $dataCreate = $request->all();
        return $this->categoryRepository->create($dataCreate);
    }

    public function destroyCategory($id)
    {
        return $this->categoryRepository->destroyCategory($id);
    }

    public function getAllCategory()
    {
        return $this->categoryRepository->getAllCategory();
    }

    public function getProductByCategoryId($id)
    {
        return $this->categoryRepository->getProductByCategoryId($id);
    }
}
