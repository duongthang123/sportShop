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
        $categories = $this->categoryService->getAllCategory();
        $products = $this->productService->GetProductSort($request);

        $view = view('layouts.productResponse', compact('products'))->render();
        return response()->json(['html' => $view]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $categories = $this->categoryService->getAllCategory();
        $products = $this->productService->getProductByCategoryId($id);
//        dd($products);

        return view('shop', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
