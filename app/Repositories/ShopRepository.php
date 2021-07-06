<?php

namespace App\Repositories;

use App\Models\Shop;

class ShopRepository {
     protected $shop;

     public function __construct(Shop $shop)
     {
          $this->shop = $shop;
     }

     public function getAll($request)
     {
          return $this->shop->where('name', 'LIKE', '%' . $request->name . '%')->paginate($request->limit);
     }

     public function save($data)
     {
          $data['admin_id'] = 1;

          $shop = new $this->shop;

          return $shop->create($data);
     }

     public function update($shop, $data)
     {
          $data['admin_id'] = 1;

          return $shop->update($data);
     }

     public function delete($shop)
     {
          return $shop->delete();
     }
}