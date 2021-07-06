<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Services\ShopService;
use Illuminate\Http\Request;
use App\Traits\JsonResponse;

class ShopController extends Controller
{
    use JsonResponse;

    protected $shopService;

    protected $shopAttributes = [
        'name', 'query', 'latitude', 'longitude', 'zoom'
    ];

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = $this->shopService->getAll($request);

        return $this->responseRetrievedList($shops);
    }

    /**
     * Store a newly created resource in storage.
     *

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only($this->shopAttributes);

        return $this->shopService->saveShop($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return $this->responseRetrieved($shop);
    }

    public function update(Request $request, Shop $shop)
    {
        $data = $request->only($this->shopAttributes);

        return $this->shopService->updateShop($data, $shop);
    }

    public function destroy(Shop $shop)
    {
        $id = $shop->id;

        $this->shopService->deleteShop($shop);

        return response($this->responseDeleted($id), 200);
    }
}
