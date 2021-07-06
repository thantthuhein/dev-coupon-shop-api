<?php

namespace App\Services;

use App\Repositories\ShopRepository;
use Illuminate\Support\Facades\Validator;
use App\Traits\JsonResponse;

class ShopService {
     use JsonResponse;

     protected $shopRepository;

     public function __construct(ShopRepository $shopRepository)
     {
          $this->shopRepository = $shopRepository;
     }

     public function getAll($request)
     {
          return $this->shopRepository->getAll($request);
     }

     public function saveShop($data)
     {
          $validationErrors = $this->validateData($data);

          if ($validationErrors) {
               return $this->responseIncorrectParams($validationErrors);
          }

          return response($this->responseCreated($this->shopRepository->save($data)), 201);
     }

     public function updateShop($data, $shop)
     {
          $validationErrors = $this->validateData($data);

          if ($validationErrors) {
               return $this->responseIncorrectParams($validationErrors);
          }

          $this->shopRepository->update($shop, $data);

          return response($this->responseUpdated($shop), 200);
     }

     public function deleteShop($shop)
     {
          return $this->shopRepository->delete($shop);
     }

     public function validateData($data)
     {
          $validator = Validator::make($data, [
               'name' => ['nullable', 'max:64'],
               'query' => ['nullable', 'max:64'],
               'latitude' => ['nullable', 'numeric'],
               'longitude' => ['nullable', 'numeric'],
               'zoom' => ['nullable', 'integer'],
          ]);

          if ($validator->fails()) {
               return $validator->errors()->getMessages();
          }

          return 0;
     }
}