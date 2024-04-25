<?php

namespace App\Http\Repository;

use App\Models\Order;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getAllOrderWithUserId($userId)
    {
        return $this->order::where('user_id', $userId)->orderByDesc('id')->paginate(5);
    }

    public function getOrderById($id)
    {
        return $this->order::where('id', $id)->first();
    }

    public function createNewOrder($dataCreate)
    {
        return $this->order->create($dataCreate);
    }

    public function getStatusOrderById($orderId, $userId)
    {
        return $this->order::select('status')
            ->where('id', $orderId)
            ->where('user_id', $userId)
            ->first();
    }

}
