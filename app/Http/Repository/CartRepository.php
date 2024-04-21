<?php

namespace App\Http\Repository;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;

class CartRepository
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function firstOrCreateBy($userId)
    {
        $cart = $this->cart::where('user_id', $userId)->first();
        if(!$cart) {
            $cart = $this->cart->create(['user_id' => $userId]);
        }

        return $cart;
    }

    public function getCartProductBy($cartId, $dataCreate)
    {
        return CartProduct::where([
            'cart_id' => $cartId,
            'product_id' => $dataCreate['product_id'],
            'product_size' => $dataCreate['size'],
            'product_color' => $dataCreate['color'],
        ])->first();
    }

    public function createCartProduct($dataCreateCart)
    {
        return CartProduct::create($dataCreateCart);
    }

    public function getCartByUserId($userId)
    {
        return $this->cart::where('user_id', $userId)->first();
    }
}
