<?php

namespace App\Http\Services\Admin;

use App\Http\Repository\Admin\CouponRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    protected $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function createCoupon($request)
    {
        $dataCreate = $request->all();
        if(!$this->checkDate($dataCreate['expery_date'])) {
            toastr()->error('Ngày hết hạn phải lớn hơn ngày hiện tại');
            return false;
        }

        try {
            $this->couponRepository->createCoupon($dataCreate);

        }catch (\Exception $e) {
            toastr()->error('Có lỗi khi thêm mới mã giảm giá');
            return false;
        }
        return true;
    }

    public function updateCoupon($request, $id)
    {
        $dataCreate = $request->all();
        $coupon = $this->couponRepository->getCouponById($id);
        if(!$this->checkDate($dataCreate['expery_date'])) {
            toastr()->error('Ngày hết hạn phải lớn hơn ngày hiện tại');
            return false;
        }

        try {
            $coupon->update($dataCreate);
        }catch (\Exception $e) {
            toastr()->error('Có lỗi khi cập nhật mã giảm giá');
            return false;
        }
        return true;
    }

    public function destroyCoupon($id)
    {
        $coupon = $this->couponRepository->getCouponById($id);
        return $coupon->delete();
    }

    protected function checkDate($experyDate)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        if($experyDate <= $currentDate) {
            return false;
        }
        return true;
    }

    public function getAllCoupon()
    {
        return $this->couponRepository->getAllCoupon();
    }

    public function getCouponById($id)
    {
        return $this->couponRepository->getCouponById($id);
    }

    public function firtWithExperyDate($name, $userId)
    {
        return $this->couponRepository->firtWithExperyDate($name, $userId);
    }
}
