<?php

namespace App\Services;

use App\Repositories\CouponShopRepository;
use Illuminate\Support\Facades\Validator;
use App\Traits\JsonResponse;

class CouponShopService {
     use JsonResponse;

     protected $couponShopRepository;

     public function __construct(CouponShopRepository $couponShopRepository)
     {
          $this->couponShopRepository = $couponShopRepository;
     }

     public function saveCouponShop($coupon_id, $shop_id)
     {
          $data = ['coupon_id' => $coupon_id, 'shop_id' => $shop_id];

          $validationErrors = $this->validateData($data);

          if ($validationErrors) {
               return $this->responseIncorrectParams($validationErrors);
          }

          return response($this->responseCreated($this->couponShopRepository->save($data)), 201);
     }

     public function find($coupon, $shop)
     {
          $couponShops = $this->couponShopRepository->find($coupon->id, $shop->id);

          return $this->responseRetrieved($couponShops);
     }

     public function get($coupon)
     {
          $couponShops = $this->couponShopRepository->get($coupon);

          return $this->responseRetrieved($couponShops);
     }

     public function delete($coupon, $shop)
     {
          $couponShop = $this->couponShopRepository->findACouponShop($coupon, $shop);

          $couponShopId = $couponShop->id;

          $this->couponShopRepository->delete($couponShop);

          return $this->responseDeleted($couponShopId, 200);
     }

     public function validateData($data)
     {
          $validator = Validator::make($data, [
               'coupon_id' => 'required',
               'shop_id' => 'required'
          ]);

          if ($validator->fails()) {
               return $validator->errors()->getMessages();
          }
     }
}