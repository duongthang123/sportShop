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

    public function revenueDay($key)
    {
        $orders = $this->order->whereDate('created_at', $key)
            ->get();

        $totalOrders = $orders->count();
        $totalMoney = $orders->where('status', 'Hoàn thành')->sum('total');
        $successfulOrders = $orders->where('status', 'Hoàn thành')->count();
        $cancelledOrders = $orders->where('status', 'Đã hủy')->count();

        return [
            'total_orders' => $totalOrders,
            'total_money' => $totalMoney,
            'successful_orders' => $successfulOrders,
            'cancelled_orders' => $cancelledOrders
        ];
    }

    public function revenueMonth($month, $year)
    {
        $orders = $this->order->whereMonth('created_at', $month)
                            ->whereYear('created_at', $year)
                            ->get();
        $totalOrders = $orders->count();
        $totalMoney = $orders->where('status', 'Hoàn thành')->sum('total');
        $successfulOrders = $orders->where('status', 'Hoàn thành')->count();
        $cancelledOrders = $orders->where('status', 'Đã hủy')->count();

        return [
            'total_orders' => $totalOrders,
            'total_money' => $totalMoney,
            'successful_orders' => $successfulOrders,
            'cancelled_orders' => $cancelledOrders
        ];
    }

    public function getAllTotalMoneyMonth($year)
    {
        $results = $this->order
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->whereYear('created_at', $year)
            ->where('status', 'Hoàn thành')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        return $results;
    }
}
