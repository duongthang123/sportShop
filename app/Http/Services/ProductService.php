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

}
