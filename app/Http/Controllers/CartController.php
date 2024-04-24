<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\CouponService;
use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;
    protected $couponService;

    public function __construct(CartService $cartService, CouponService $couponService)
    {
        $this->cartService = $cartService;
        $this->couponService = $couponService;
    }
    public function index()
    {
        $userId = Auth::user()->id;
        $carts = $this->cartService->firstOrCreateBy($userId)->load('products');
        return view('cart', compact('carts'));
    }

    public function store(Request $request)
    {

    }

    public function updateQuantity(Request $request)
    {
        $userId = Auth::user()->id;
        $carts = $this->cartService->firstOrCreateBy($userId);

        $result = $this->cartService->updateQuantityProductInCart($carts->id, $request);
        if($result) {
            toastr()->success('Cập nhật giỏ hàng thành công');
            return response()->json([
                'error' => false,
            ]);
        }

        toastr()->error('Số lượng sản phẩm không đủ');
        return response()->json([
            'error' => false,
        ]);
    }

    public function deleteProductInCart(Request $request)
    {
        $userId = Auth::user()->id;
        $carts = $this->cartService->firstOrCreateBy($userId);

        $result = $this->cartService->deleteProductInCart($carts->id, $request);
        if($result) {
            toastr()->success('Xóa sản phẩm khỏi giỏ hàng thành công!');
            return response()->json([
                'error' => false,
            ]);
        }
        toastr()->error('Có lỗi xảy ra!');
        return response()->json([
            'error' => true,
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $name = $request->input('coupon');
        $coupon = $this->couponService->firtWithExperyDate($name, Auth::user()->id);

        if($coupon) {
            Session::put('coupon_id', $coupon->id);
            Session::put('coupon_value', $coupon->value);
            Session::put('coupon_code', $coupon->name);
            toastr()->success('Áp dụng mã giảm giá thành công');
        } else {
            Session::forget(['coupon_id', 'coupon_value', 'coupon_code']);
            toastr()->error('Mã giảm giá không tồn tại hoặc đã hết hạn');
        }

        return redirect()->route('cart');
    }

    public function checkout()
    {
        $userId = Auth::user()->id;
        $carts = $this->cartService->firstOrCreateBy($userId)->load('products');

        return view('checkout', compact('carts'));
    }
}
