<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
//        $this->middleware('auth');
        $this->productService = $productService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productNews = $this->productService->getProductNews();
        $productSales = $this->productService->getProductSale();
        return view('home', compact('productNews', 'productSales'));
    }
}
