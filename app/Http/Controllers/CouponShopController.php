<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Shop;
use App\Models\CouponShop;
use App\Services\CouponShopService;
use Illuminate\Http\Request;
use App\Traits\JsonResponse;

class CouponShopController extends Controller
{
    use JsonResponse;

    protected $couponShopAttributes = ['coupon_id', 'shop_id'];

    protected $couponShopService;

    public function __construct(CouponShopService $couponShopService)
    {
        $this->couponShopService = $couponShopService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Coupon $coupon)
    {
        return $this->couponShopService->get($coupon);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Coupon $coupon)
    {
        return $this->couponShopService->saveCouponShop($coupon->id, $request->shop_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CouponShop  $couponShop
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon, Shop $shop)
    {
        return $this->couponShopService->find($coupon, $shop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CouponShop  $couponShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon, Shop $shop)
    {
        return $this->couponShopService->delete($coupon, $shop);
    }
}
