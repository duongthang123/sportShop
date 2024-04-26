<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\CouponService;
use Illuminate\Http\Request;
use willvincent\Feeds\Facades\FeedsFacade;

class NewsFeedController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }
    public function index()
    {
        $feed = FeedsFacade::make('https://vnexpress.net/rss/the-thao.rss');
        $data = array(
            'title' => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items' => $feed->get_items(),
        );

        return view('newsFeed', $data);
    }

    public function coupon()
    {
        $coupons = $this->couponService->getAllCoupon();
        return view('coupon', compact('coupons'));
    }
}
