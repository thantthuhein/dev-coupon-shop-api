<?php

namespace App\Repositories;

use App\Models\Coupon;

class CouponRepository {
     protected $coupon;

     public function __construct(Coupon $coupon)
     {
          $this->coupon = $coupon;
     }

     public function getAll($request)
     {
          return $this->coupon->where('name', 'LIKE', '%' . $request->name . '%')->paginate($request->limit);
     }

     public function save($data)
     {
          $data['admin_id'] = 1;

          $coupon = new $this->coupon;

          return $coupon->create($data);
     }

     public function update($coupon, $data)
     {
          $data['admin_id'] = 1;

          return $coupon->update($data);
     }

     public function delete($coupon)
     {
          return $coupon->delete();
     }
}