<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Models\Coupon;
use App\Models\CouponShop;

class CouponShopRepository {
     protected $couponShop;

     public function __construct(CouponShop $couponShop)
     {
          $this->couponShop = $couponShop;
     }

     public function save($data)
     {
          $couponShop = new $this->couponShop;

          $shop = Shop::findOrFail($data['shop_id']);

          return $couponShop->create([
               'coupon_id' => $data['coupon_id'],
               'shop_id' => $data['shop_id']
          ]);
     }

     public function findACouponShop($coupon, $shop)
     {
          return $this->couponShop->where('coupon_id', $coupon->id)->where('shop_id', $shop->id)->get();
     }

     public function find($coupon_id, $shop_id)
     {
          $coupon = Coupon::find($coupon_id);

          $coupon['shops'] = $coupon->shops();

          return $coupon;
     }

     public function get($coupon)
     {
          $coupon['shops'] = $coupon->shops();

          return $coupon;
     }

     public function delete($couponShop)
     {
          return $couponShop->delete();
     }
}