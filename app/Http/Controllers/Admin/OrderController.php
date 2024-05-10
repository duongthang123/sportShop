<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\OrderService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->orderService->getAllOrder();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = $this->orderService->getOrderById($id)->load('products');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, string $id)
    {
        $result = $this->orderService->updateStatusOrder($request);
        if($result) {
            toastr()->success('Cập nhật trạng thái đơn hàng thành công!');
            return response()->json([
                'error' => false,
            ]);
        }
        toastr()->error('Cập nhật trạng thái đơn hàng thất bại!');
        return response()->json([
            'error' => true,
        ]);
    }

    public function orderPdf($id)
    {
        $order = $this->orderService->getOrderById($id)->load('products');
        $pdf = PDF\Pdf::loadView('admin.orders.pdfFile', compact('order'));;
        return $pdf->stream('admin.orders.pdfFile.pdf');
    }

    public function orderFilter(Request $request)
    {
        $orders = $this->orderService->getOrderByStatus($request);
        return view('admin.orders.index', compact('orders'));
    }

    public function search(Request $request)
    {
        $orders = $this->orderService->searchOrder($request);
        return view('admin.orders.index', compact('orders'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
