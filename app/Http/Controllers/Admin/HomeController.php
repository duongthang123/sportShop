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
}
