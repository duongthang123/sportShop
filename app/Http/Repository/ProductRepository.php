<?php

namespace App\Http\Repository;

use App\Models\Product;

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
}
