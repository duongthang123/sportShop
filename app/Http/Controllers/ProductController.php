<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id)
    {
        $product = $this->productService->getProductById($id);
        $categories = $product->categories;
        $productsRelate = $this->productService->getProductRelateByCategoryId($categories[0]->id);
        return view('product', compact('product', 'categories', 'productsRelate'));
    }
}
