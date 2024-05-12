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

    public function searchOrder($request)
    {
        return $this->orderRepository->searchOrder($request);
    }

    public function getTotalRevenue()
    {
        return $this->orderRepository->getTotalRevenue();
    }

    public function numberOrderSuccess()
    {
        return $this->orderRepository->numberOrderSuccess();
    }

    public function numberOrderDestroy()
    {
        return $this->orderRepository->numberOrderDestroy();
    }

    public function revenueDay($key)
    {
        return $this->orderRepository->revenueDay($key);
    }

    public function revenueMonth($month, $year)
    {
        return $this->orderRepository->revenueMonth($month, $year);
    }
}
