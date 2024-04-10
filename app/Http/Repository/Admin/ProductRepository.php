<?php

namespace App\Http\Repository\Admin;

use App\Http\Repository\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllProductWithPaginate()
    {
        return $this->product::latest('id')->paginate(5);
    }

    public function getProductById($id)
    {
        return $this->product::with( 'details')->find($id);
    }

    public function findProductById($id)
    {
        return $this->product::findOrFail($id);
    }
    public function createProduct($dataCreate)
    {
        return $this->product::create($dataCreate);
    }

    public function saveImage($request)
    {
        return $this->product->saveImage($request);
    }

    public function updateImage($request, $currentImage)
    {
        return $this->product->updateImage($request, $currentImage);
    }

    public function deleteImage($currentImage)
    {
        return $this->product->deleteImage($currentImage);
    }

}
