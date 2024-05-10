<?php

namespace App\Http\Repository\Admin;

use App\Http\Repository\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getAllOrder()
    {
        return $this->order::latest('id')->paginate(10);
    }

    public function getOrderById($orderId)
    {
        return $this->order::where('id', $orderId)->first();
    }

    public function getOrderByStatus($statusOrder)
    {
        return $this->order::where('status', $statusOrder)->latest('id')->paginate(10);
    }

    public function searchOrder($request)
    {
        return $this->order::search($request)->latest('id')->paginate(10);
    }

    public function getTotalRevenue()
    {
        return $this->order::where('status', 'Hoàn thành')->sum('total');
    }

    public function numberOrderSuccess()
    {
        return $this->order::where('status', 'Hoàn thành')->count('id');
    }

    public function numberOrderDestroy()
    {
        return $this->order::where('status', 'Đã hủy')->count('id');
    }
}
