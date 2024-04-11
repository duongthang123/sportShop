<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupons\CreateCouponRequest;
use App\Http\Requests\Coupons\UpdateCouponRequest;
use App\Http\Services\Admin\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = $this->couponService->getAllCoupon();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCouponRequest $request)
    {
        $result = $this->couponService->createCoupon($request);
        if ($result) {
            toastr()->success('Thêm mã giảm giá thành công');
            return redirect()->route('coupons.index');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = $this->couponService->getCouponById($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, string $id)
    {
        $result = $this->couponService->updateCoupon($request, $id);
        if ($result) {
            toastr()->success('Cập nhật mã giảm giá thành công');
            return redirect()->route('coupons.index');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->couponService->destroyCoupon($id);
        if($result) {
            toastr()->success('Xóa mã giảm giá thành công!');
            return response()->json([
                'error' => false,
            ]);
        }
        return response()->json([
            'error' => false,
        ]);
    }
}
