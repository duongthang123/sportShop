<?php

namespace App\Http\Repository;

use App\Models\Product;
use App\Models\ProductDetails;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProductNews($limit = 12)
    {
        return $this->product::select('id', 'name', 'price', 'sale')
            ->where('active', 1)->orderByDesc('id')->limit($limit)->get();
    }

    public function getProductSale($limit = 12)
    {
        return $this->product::select('id', 'name', 'price', 'sale')
            ->where('active', 1)
            ->where('sale', '>', 1)
            ->limit($limit)->get();
    }

    public function getProductBestSale($limit = 12)
    {
        return $this->product::select('id', 'name', 'price', 'sale')
            ->where('active', 1)
            ->where('quantity_sell', '>', 0)
            ->orderByDesc('quantity_sell')
            ->limit($limit)->get();
    }

    public function getAll()
    {
        return $this->product::select('id', 'name', 'price', 'sale')
            ->where('active', 1)->orderByDesc('id')->paginate(12);
    }

    public function getProductAsc()
    {
        return $this->product::select('id', 'name', 'price', 'sale')
            ->where('active', 1)->orderBy('price')->paginate(12);
    }

    public function getProductDesc()
    {
        return $this->product::select('id', 'name', 'price', 'sale')
            ->where('active', 1)->orderByDesc('price')->paginate(12);
    }
    public function getProductByCategoryId($id)
    {
        return $this->product::whereHas('categories', fn($q) => $q->where('category_id', $id))->where('active', 1)->paginate(12);
    }

    public function getProductAscByCategoryId($categoryId)
    {
        return $this->product::whereHas('categories', fn($q) => $q->where('category_id', $categoryId))->orderBy('price')->paginate(12);
    }

    public function getProductDescByCategoryId($categoryId)
    {
        return $this->product::whereHas('categories', fn($q) => $q->where('category_id', $categoryId))->orderByDesc('price')->paginate(12);
    }

    public function filterProductByPrice($minPrice, $maxPrice)
    {
        return $this->product::whereBetween('price', [$minPrice, $maxPrice])->paginate(12);
    }

    public function filterProductByPriceAndCategoryId($minPrice, $maxPrice, $categoryId)
    {
        return $this->product::whereHas('categories', fn($q) => $q->where('category_id', $categoryId))->whereBetween('price', [$minPrice, $maxPrice])->paginate(12);
    }

    public function searchProduct($request)
    {
        return $this->product::search($request)->latest()->paginate(12);
    }

    public function getProductById($id)
    {
        return $this->product::with('details')->where([
            'id' => $id,
            'active' => 1
        ])->first();
    }

    public function getProductRelateByCategoryId($id)
    {
        return $this->product::whereHas('categories', fn($q) => $q->where('category_id', $id))
            ->where('active', 1)->paginate(4);
    }

    public function getProductByIdAndSizeColor($dataCreate)
    {
        return ProductDetails::select('quantity')->where([
            'product_id' => $dataCreate['product_id'],
            'size' => $dataCreate['size'],
            'color' => $dataCreate['color'],
        ])->first();
    }

    public function getProductBy($dataCreate)
    {
        return ProductDetails::where([
            'product_id' => $dataCreate['product_id'],
            'size' => $dataCreate['product_size'],
            'color' => $dataCreate['product_color'],
        ])->first();
    }

    public function updateQuantitySellProductById($productId, $productQuantity)
    {
        return $this->product::where('id', $productId)->update(['quantity_sell' => $productQuantity]);
    }
}
