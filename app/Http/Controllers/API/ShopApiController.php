<?php

namespace App\Http\Controllers\API;

use App\Shop;
use Auth;
use JWTAuth;
use App\User;
use Response;
use Validator;
use JWTFactory;
use App\Product;
use App\Wishlist;
use App\Cart;
use App\BusinessSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;

class ShopApiController extends Controller
{
    //Get all Shop's list
    public function index(){
        try {
            $shops = Shop::all();
            foreach ($shops as $key => $shop){
                $data[$key]['id']= $shop->id;
                $data[$key]['name']= $shop->name;
                $data[$key]['logo']= $shop->logo;
                $data[$key]['sliders']= $shop->sliders;
                $data[$key]['address']= $shop->address;
                $data[$key]['facebook']= $shop->facebook;
                $data[$key]['google']= $shop->google;
                $data[$key]['twitter']= $shop->twitter;
                $data[$key]['youtube']= $shop->youtube;
                $data[$key]['instagram']= $shop->instagram;
                $data[$key]['slug']= $shop->slug;
                $data[$key]['meta_title']= $shop->meta_title;
                $data[$key]['meta_description']= $shop->meta_description;
                $data[$key]['user']= $shop->user;
            }
            return $this->sendResponse($data, 'Shops retrieved successfully.');

        }catch (\Exception $e){
            return $this->sendError('products not found', 404);
        }
    }

    /**
     * Display the specified shop.
     * GET|HEAD /shops/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var Shop $shop */
        try {
            $shop = Shop::findOrFail($id);
            $data['id']= $shop->id;
            $data['name']= $shop->name;
            $data['logo']= $shop->logo;
            $data['sliders']= $shop->sliders;
            $data['address']= $shop->address;
            $data['facebook']= $shop->facebook;
            $data['google']= $shop->google;
            $data['twitter']= $shop->twitter;
            $data['youtube']= $shop->youtube;
            $data['instagram']= $shop->instagram;
            $data['slug']= $shop->slug;
            $data['meta_title']= $shop->meta_title;
            $data['meta_description']= $shop->meta_description;
            $data['user']= $shop->user;
            return $this->sendResponse($shop, 'Shops retrieved successfully.');

        }catch (\Exception $e){
            return $this->sendError('shops not found', 404);
        }
    }
}
