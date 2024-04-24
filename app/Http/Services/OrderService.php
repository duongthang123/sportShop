<?php

namespace App\Http\Services;

use App\Http\Repository\OrderRepository;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderService
{
    protected $orderRepository;
    protected $cartService;
    protected $coupon;

    public function __construct(
        OrderRepository $orderRepository,
        CartService $cartService,
        Coupon $coupon,
        OrderProductService $orderProductService
    ) {
        $this->orderRepository = $orderRepository;
        $this->cartService = $cartService;
        $this->coupon = $coupon;
        $this->orderProductService = $orderProductService;
    }

    public function getAllOrderWithUserId($userId)
    {
        return $this->orderRepository->getAllOrderWithUserId($userId);
    }

    public function cancelOrderById($id)
    {
        $order = $this->orderRepository->getOrderById($id);
        $orderAt = strtotime($order->created_at);
        $currentTime = time();
        $timeCancel = ($currentTime - $orderAt) / (60 * 60);
        if ($timeCancel > 2) {
            toastr()->error('Bạn không thể hủy do đơn đã quá thời gian hủy');
            return false;
        }
        $order->update(['status' => 'Đã hủy']);
        return true;
    }
    public function createNewOrder($request)
    {
        $dataCreate = $request->all();
        try {
            $userId = Auth::user()->id;
            $dataCreate['user_id'] = $userId;
            $dataCreate['status'] = 'Đợi duyệt';
            $cart = $this->cartService->firstOrCreateBy($userId)->load('products');

            $order = $this->orderRepository->createNewOrder($dataCreate);
            $this->createOrderProduct($cart, $order->id);

            $couponId = Session::get('coupon_id');
            if($couponId) {
                $coupon = $this->coupon->find($couponId);
                if($coupon) {
                    $coupon->users()->attach($userId, ['value' => $coupon->value, 'order_id' => $order->id]);
                }
            }

            $cart->products()->delete();
            Session::forget(['coupon_id', 'coupon_value', 'coupon_code']);
            return true;
        } catch (\Exception $e)
        {
            toastr()->error('Có lỗi, không thể đặt hàng', $e->getMessage());
            return false;
        }
    }

    private function createOrderProduct($cart, $orderId)
    {
        return $this->orderProductService->createOrderProduct($cart, $orderId);
    }
}
