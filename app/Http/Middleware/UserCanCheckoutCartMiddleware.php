<?php

namespace App\Http\Middleware;

use App\Http\Services\CartService;
use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserCanCheckoutCartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = app(CartService::class)->firstOrCreateBy(Auth::user()->id);
        if($cart->products->count() > 0) {
            return $next($request);

        } else {
            toastr()->error('Không có sản phẩm nào trong giỏ hàng', 'Cảnh báo');
            return redirect()->route('cart');
        }
    }
}
