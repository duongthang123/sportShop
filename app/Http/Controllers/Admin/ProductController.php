<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Services\Admin\CategoryService;
use App\Http\Services\Admin\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getAllProductWithPaginate();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getCategoryForProduct();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $result = $this->productService->createProduct($request);
        if($result) {
            return redirect()->route('products.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = $this->categoryService->getCategoryForProduct();
        $product = $this->productService->getProductById($id);
        return view('admin.products.show', compact('categories','product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = $this->categoryService->getCategoryForProduct();
        $product = $this->productService->getProductById($id);
        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = $this->productService->updateProduct($request, $id);
        if($result) {
            return redirect()->route('products.index');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->productService->destroyProduct($id);
        if($result) {
            toastr()->success('Xóa sản phẩm thành công');
            return response()->json([
                'error' => false,
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }

    public function search(Request $request)
    {
        $products = $this->productService->search($request);
        return view('admin.products.index', compact('products'));
    }
}
