<?php

namespace App\Http\Services;

use App\Http\Repository\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProductNews()
    {
        return $this->productRepository->getProductNews();
    }

    public function getProductSale()
    {
        return $this->productRepository->getProductSale();
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function GetProductSort($request)
    {
        if($request->has('price')) {
            $option = $request->price;
            switch ($option) {
                case 'asc':
                    $products = $this->productRepository->getProductAsc();
                    break;
                case 'desc':
                    $products = $this->productRepository->getAll();
                default:
                    $products = $this->productRepository->getAll();
                    break;
            }
        } else {
            $products = $this->productRepository->getAll();
        }
        return $products;
    }

    public function getProductByCategoryId($id)
    {
        return $this->productRepository->getProductByCategoryId($id);
    }

}
