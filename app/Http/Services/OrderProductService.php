<?php

namespace App\Http\Services;

use App\Http\Repository\OrderProductRepository;
use App\Http\Repository\OrderRepository;
use App\Models\Coupon;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderProductService
{
    protected $productOrderRepository;
    protected $productService;

    public function __construct(OrderProductRepository $productOrderRepository, ProductService $productService)
    {
        $this->productOrderRepository = $productOrderRepository;
        $this->productService = $productService;
    }

    public function createOrderProduct($cart, $orderId)
    {
        foreach ($cart['products'] as $product) {
            $productId = $product['product_id'];
            $this->productService->updateQuantitySellProductById($productId, $product['product_quantity']);
            $orderProduct = new ProductOrder([
                'product_id' => $product['product_id'],
                'product_size' => $product['product_size'],
                'product_color' => $product['product_color'],
                'product_quantity' => $product['product_quantity'],
                'product_price' => $product['product_price'],
                'order_id' => $orderId
            ]);
            $orderProduct->save();
            $this->productService->updateQuantityProduct($orderProduct);
        }
        return true;
    }
}
