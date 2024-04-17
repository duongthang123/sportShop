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

            if($request->has('category_id')) {
                $categoryId = $request->category_id;
                switch ($option) {
                    case 'asc':
                        $products = $this->productRepository->getProductAscByCategoryId($categoryId);
                        break;
                    case 'desc':
                        $products = $this->productRepository->getProductDescByCategoryId($categoryId);
                        break;
                    default:
                        $products = $this->productRepository->getProductDescByCategoryId($categoryId);
                        break;
                }
            } else {
                switch ($option) {
                    case 'asc':
                        $products = $this->productRepository->getProductAsc();
                        break;
                    case 'desc':
                        $products = $this->productRepository->getProductDesc();
                        break;
                    default:
                        $products = $this->productRepository->getProductDesc();
                        break;
                }
            }

        } else {
            $products = $this->productRepository->getAll();
        }
        return $products;
    }

    public function getProductFilter($request)
    {
        $priceRange = $request->input('price_range');
        $priceRangeArray = explode('-', $priceRange);
        $minPrice = $priceRangeArray[0];
        $maxPrice = $priceRangeArray[1];

        if($request->has('category_id')) {
            $products = $this->productRepository->filterProductByPriceAndCategoryId($minPrice, $maxPrice, $request->category_id);
        } else {
            $products = $this->productRepository->filterProductByPrice($minPrice, $maxPrice);
        }

        return $products;
    }

    public function getProductByCategoryId($id)
    {
        return $this->productRepository->getProductByCategoryId($id);
    }

    public function searchProduct($request)
    {
        return $this->productRepository->searchProduct($request);
    }

}
