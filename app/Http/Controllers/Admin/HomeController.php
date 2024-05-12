<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\OrderService;
use App\Http\Services\Admin\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $orderService;
    protected $userService;

    public function __construct(OrderService $orderService, UserService $userService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $totalRevenue = $this->orderService->getTotalRevenue();
        $orderSuccess = $this->orderService->numberOrderSuccess();
        $numberOrderDestroy = $this->orderService->numberOrderDestroy();
        $numberUser = $this->userService->numberUser();
        return view('admin.home', [
            'totalRevenue' => $totalRevenue,
            'orderSuccess' => $orderSuccess,
            'numberOrderDestroy' => $numberOrderDestroy,
            'numberUser' => $numberUser
        ]);
    }

    public function revenue()
    {
        return view('admin.dashboard.revenue');
    }

    public function revenueDay(Request $request)
    {
        $key = $request->input('key');
        $results = $this->orderService->revenueDay($key);
        return view('admin.dashboard.revenue', [
            'title' => 'Thống kê theo ngày: ' . $key,
            'date' => $key,
            'results' => $results
        ]);
    }

    public function revenueMonth(Request $request)
    {
        $month = $request->input('month');
        $time = now();
        $results = $this->orderService->revenueMonth($month, $time->format('Y'));
        return view('admin.dashboard.revenue', [
            'title' => 'Thống kê theo tháng: ' . $month . ' | Năm: ' . $time->format('Y'),
            'month' => $month,
            'results' => $results
        ]);
    }
}
