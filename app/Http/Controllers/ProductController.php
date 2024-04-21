<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productService;
    protected $cartService;

    public function __construct(ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }

    public function index($id)
    {
        $product = $this->productService->getProductById($id);
        $categories = $product->categories;
        $productsRelate = $this->productService->getProductRelateByCategoryId($categories[0]->id);
        return view('product', compact('product', 'categories', 'productsRelate'));
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $cart = $this->cartService->firstOrCreateBy($userId);
        $result  = $this->cartService->updateOrCreateCart($request, $cart->id);
        if ($result) {
            return redirect()->route('cart');
        }
        return redirect()->back();
    }
}
