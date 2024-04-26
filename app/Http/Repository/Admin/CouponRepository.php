<?php

namespace App\Http\Repository\Admin;

use App\Models\Coupon;
use App\Models\Product;

class CouponRepository
{
    protected $coupon;

    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function createCoupon($dataCreate)
    {
        return $this->coupon->create($dataCreate);
    }

    public function getAllCoupon()
    {
        return $this->coupon::latest('id')->paginate(6);
    }

    public function getCouponById($id)
    {
        return $this->coupon::where('id', $id)->first();
    }

    public function firtWithExperyDate($name, $userId)
    {
        return $this->coupon->firtWithExperyDate($name, $userId);
    }


}
