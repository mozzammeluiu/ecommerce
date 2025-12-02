<?php

namespace App\Http\Controllers\API;

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

class ProductApiController extends Controller
{
    //Get all products
    public function index(){
        try {
            $products = Product::all();
            foreach ($products as $key => $product){
            $data[$key]['id']=$product->id;
            $data[$key]['name']=$product->name;
            $data[$key]['category']=$product->category;
            $data[$key]['sub_category']=$product->subcategory;
            $data[$key]['sub_sub_category']=$product->subsubcategory;
            $data[$key]['brand']=$product->brand;
            $data[$key]['user']=$product->user;
            $data[$key]['description']=$product->description;
            $data[$key]['unit_price']=$product->unit_price;
            $data[$key]['purchase_price']=$product->purchase_price;
            $data[$key]['colors']=$product->colors;
            $data[$key]['variations']=$product->variations;
            $data[$key]['unit']=$product->unit;
            $data[$key]['discount']=$product->discount;
            $data[$key]['discount_type']=$product->discount_type;
            $data[$key]['tax']=$product->tax;
            $data[$key]['tax_type']=$product->tax_type;
            $data[$key]['shipping_type']=$product->shipping_type;
            $data[$key]['shipping_cost']=$product->shipping_cost;
            $data[$key]['num_of_sale']=$product->num_of_sale;
            $data[$key]['meta_title']=$product->meta_title;
            $data[$key]['meta_description']=$product->meta_description;
            $data[$key]['meta_img']=$product->meta_img;
            $data[$key]['pdf']=$product->pdf;
            $data[$key]['slug']=$product->pdf;
            $data[$key]['rating']=$product->pdf;
            $data[$key]['photos']=$product->photos;
            $data[$key]['thumbnail_img']=$product->thumbnail_img;
            $data[$key]['featured_img']=$product->featured_img;
            $data[$key]['flash_deal_img']=$product->flash_deal_img;
            }
            return $this->sendResponse($data, 'Products retrieved successfully.');

        }catch (\Exception $e){
            return $this->sendError('products not found', 404);
        }
    }

    /**
     * Display the specified Food.
     * GET|HEAD /products/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var Product $product */
        try {
            $product = Product::findOrFail($id);
            $data['id']=$product->id;
            $data['name']=$product->name;
            $data['category']=$product->category;
            $data['sub_category']=$product->subcategory;
            $data['sub_sub_category']=$product->subsubcategory;
            $data['brand']=$product->brand;
            $data['user']=$product->user;
            $data['description']=$product->description;
            $data['unit_price']=$product->unit_price;
            $data['purchase_price']=$product->purchase_price;
            $data['colors']=$product->colors;
            $data['variations']=$product->variations;
            $data['unit']=$product->unit;
            $data['discount']=$product->discount;
            $data['discount_type']=$product->discount_type;
            $data['tax']=$product->tax;
            $data['tax_type']=$product->tax_type;
            $data['shipping_type']=$product->shipping_type;
            $data['shipping_cost']=$product->shipping_cost;
            $data['num_of_sale']=$product->num_of_sale;
            $data['meta_title']=$product->meta_title;
            $data['meta_description']=$product->meta_description;
            $data['meta_img']=$product->meta_img;
            $data['pdf']=$product->pdf;
            $data['slug']=$product->pdf;
            $data['rating']=$product->pdf;
            $data['photos']=$product->photos;
            $data['thumbnail_img']=$product->thumbnail_img;
            $data['featured_img']=$product->featured_img;
            $data['flash_deal_img']=$product->flash_deal_img;
            return $this->sendResponse($data, 'Products retrieved successfully.');

        }catch (\Exception $e){
            return $this->sendError('products not found', 404);
        }
    }
}
