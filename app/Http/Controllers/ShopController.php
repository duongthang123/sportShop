<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\CategoryService;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $categoryService;
    protected $productService;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategory();
        $products = $this->productService->getAll();

        return view('shop', compact('categories', 'products'));
    }

    public function sort(Request $request)
    {
        $products = $this->productService->GetProductSort($request);

        $view = view('layouts.productResponse', compact('products'))->render();
        return response()->json(['html' => $view]);
    }

    public function filterProduct(Request $request)
    {
        $products = $this->productService->getProductFilter($request);

        $view = view('layouts.productResponse', compact('products'))->render();
        return response()->json(['html' => $view]);
    }

    public function search(Request $request)
    {
        $categories = $this->categoryService->getAllCategory();

        $products = $this->productService->searchProduct($request);
        return view('shop', compact('categories', 'products'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $categories = $this->categoryService->getAllCategory();
        $products = $this->productService->getProductByCategoryId($id);

        return view('shop', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

}
