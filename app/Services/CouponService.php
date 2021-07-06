<?php

namespace App\Services;

use App\Repositories\CouponRepository;
use Illuminate\Support\Facades\Validator;
use App\Rules\CouponType;
use App\Rules\DiscountType;
use App\Exceptions\InvalidParamException;
use App\Traits\JsonResponse;

class CouponService {
     use JsonResponse;

     protected $couponRepository;

     public function __construct(CouponRepository $couponRepository)
     {
          $this->couponRepository = $couponRepository;
     }

     public function getAll($request)
     {
          return $this->couponRepository->getAll($request);
     }

     public function saveCoupon($data)
     {
          $validationErrors = $this->validateData($data);

          if ($validationErrors) {
               return $this->responseIncorrectParams($validationErrors);
          }

          return response($this->responseCreated($this->couponRepository->save($data)), 201);
     }

     public function updateCoupon($data, $coupon)
     {
          $validationErrors = $this->validateData($data);

          if ($validationErrors) {
               return $this->responseIncorrectParams($validationErrors);
          }

          $this->couponRepository->update($coupon, $data);

          return response($this->responseUpdated($coupon), 200);
     }

     public function deleteCoupon($coupon)
     {
          return $this->couponRepository->delete($coupon);
     }

     public function validateData($data)
     {
          $validator = Validator::make($data, [
               'name' => ['required', 'max:128'],
               'description' => ['nullable'],
               'discount_type' => ['required', new DiscountType],
               'amount' => ['required', 'integer'],
               'code' => ['nullable', 'integer'],
               'start_datetime' => ['nullable', 'date_format:Y-m-d H:i:s'],
               'end_datetime' => ['nullable', 'date_format:Y-m-d H:i:s'],
               'coupon_type' => ['required', new CouponType],
               'used_count' => ['nullable', 'integer']
          ]);

          if ($validator->fails()) {
               return $validator->errors()->getMessages();
          }

          return 0;
     }
}