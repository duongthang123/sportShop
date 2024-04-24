<?php

namespace App\Http\Services\Admin;

use App\Http\Repository\Admin\CategoryRepository;
use App\Http\Repository\Admin\OrderRepository;
use App\Http\Repository\Admin\UserRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrder()
    {
        return $this->orderRepository->getAllOrder();
    }

    public function updateStatusOrder($request)
    {
        $data = $request->all();
        $order = $this->orderRepository->getOrderById($data['id']);
        if($order) {
            if ($data['status'] == 'Hoàn thành') {
                $order->update(['status_payment' => 'Đã thanh toán' ]);
            }
            $order->update(['status' => $data['status']]);
            return true;
        }
        return false;
    }

    public function getOrderById($id)
    {
        return $this->orderRepository->getOrderById($id);
    }

    public function getOrderByStatus($request)
    {
        $data = $request->all();
        return $this->orderRepository->getOrderByStatus($data['status']);
    }

}
