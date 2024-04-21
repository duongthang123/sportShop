<?php

namespace App\View\Composers;

use App\Http\Repository\CartRepository;
use Illuminate\View\View;

class CartComposer
{
    protected $cartRepository;
    /**
     * Create a new profile composer.
     */
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('countProductInCart', $this->countProductInCart());
    }

    public function countProductInCart()
    {
        if(auth()->check()) {
            $cart = $this->cartRepository->getCartByUserId(auth()->user()->id);
            return $cart ? $cart->products->count() : 0;
        }
        return 0;
    }
}
