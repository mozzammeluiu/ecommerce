<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\InstamojoController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PublicSslCommerzPaymentController;
use App\Http\Controllers\OrderController;
use App\Order;
use App\BusinessSetting;
use App\Coupon;
use App\CouponUsage;
use Session;
use App\Staff;

class DriverController extends Controller
{

    public function __construct()
    {
        //
    }
    public function index($id){
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;

        $orders = Order::where('delivery_man_id', $id)
            ->where('delivery_status','!=','delivered')
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('users', 'users.id', '=', 'order_details.seller_id')
            ->select('products.name as product_name','orders.grand_total',
                'order_details.quantity','order_details.price','order_details.tax',
                'users.name as user_name','orders.shipping_address','orders.code',
                'orders.payment_type','orders.payment_status','users.name as seller_name','orders.id as id'
                )
            ->orderBy('orders.created_at','desc')
            ->paginate(15);
        return view('driver_orders.index',compact('orders','payment_status','delivery_status','sort_search'));
    }
    public function delivered($id)
    {
        $order_details = OrderDetail::where('order_id',$id)->update(['delivery_status' => 'delivered']);
        return redirect('/driver/orders');
    }
    public function driver(Request $request)
    {
        $order = Order::where('id',$request->order_id)->update(['delivery_man_id' => $request->driver_id]);
        if($order){
            return "success";
        }else{
            return "not success";
        }
    }

}
