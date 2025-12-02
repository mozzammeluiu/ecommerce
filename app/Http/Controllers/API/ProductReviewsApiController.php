<?php

namespace App\Http\Controllers\API;

use App\Review;
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

class ProductReviewsApiController extends Controller
{
    //Get all products
    public function index(){
        try {
            $reviews = Review::all();
            foreach ($reviews as $key => $review){
            }
            return $this->sendResponse($reviews, 'Product Reviews retrieved successfully.');

        }catch (\Exception $e){
            return $this->sendError('products not found', 404);
        }
    }

    /**
     * Display the specified product review.
     * GET|HEAD /product_reviews/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var Review $review */
        try {
            $review = Review::findOrFail($id);
            return $this->sendResponse($review, 'Product Reviews retrieved successfully.');

        }catch (\Exception $e){
            return $this->sendError('products not found', 404);
        }
    }
}
