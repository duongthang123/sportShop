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
}
