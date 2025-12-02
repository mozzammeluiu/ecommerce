@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Orders')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_orders" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="payment_type" id="payment_type" onchange="sort_orders()">
                            <option value="">{{__('Filter by Payment Status')}}</option>
                            <option value="paid"  @isset($payment_status) @if($payment_status == 'paid') selected @endif @endisset>{{__('Paid')}}</option>
                            <option value="unpaid"  @isset($payment_status) @if($payment_status == 'unpaid') selected @endif @endisset>{{__('Un-Paid')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="delivery_status" id="delivery_status" onchange="sort_orders()">
                            <option value="">{{__('Filter by Deliver Status')}}</option>
                            <option value="pending"   @isset($delivery_status) @if($delivery_status == 'pending') selected @endif @endisset>{{__('Pending')}}</option>
                            <option value="on_review"   @isset($delivery_status) @if($delivery_status == 'on_review') selected @endif @endisset>{{__('On review')}}</option>
                            <option value="on_delivery"   @isset($delivery_status) @if($delivery_status == 'on_delivery') selected @endif @endisset>{{__('On delivery')}}</option>
                            <option value="delivered"   @isset($delivery_status) @if($delivery_status == 'delivered') selected @endif @endisset>{{__('Delivered')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Order Code')}}</th>
                    <th>Quantity</th>
                    <th>Seller Name</th>
                    <th>Shipping Address</th>
                    <th>{{__('Payment Method')}}</th>
                    <th>{{__('Payment Status')}}</th>
                    <th>Payment Amount</th>
                    <th width="10%">{{__('Options')}}</th>
{{--                    <th>{{__('Delivery Status')}}</th>--}}
{{--                    <th>{{__('Payment Method')}}</th>--}}
{{--                    <th>{{__('Payment Status')}}</th>--}}
{{--                    <th width="10%">{{__('Options')}}</th>--}}
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    @if($order != null)
                        <tr>
                            <td>
                                {{ ($key+1) }}
                            </td>
                            <td>
                                {{ $order->code }}
{{--                                @if($order->viewed == 0) <span class="pull-right badge badge-info">{{ __('New') }}</span> @endif--}}
                            </td>
                            <td>
                                {{ $order->quantity   }}
                            </td>
                            <td>
                                {{ $order->seller_name }}
                            </td>
                            <td>
                                <small>Name: <b>{{ json_decode($order->shipping_address)->name }}</b></small><br>
                                <small>Address: {!! json_decode($order->shipping_address)->address !!}</small><br>
                                <small>City: {{ json_decode($order->shipping_address)->city  }}</small><br>
                                <small>Coutry: {{ json_decode($order->shipping_address)->country  }}</small><br>
                                <small>Postal code: {{ json_decode($order->shipping_address)->postal_code }}</small><br>
                                <small>Phone Number: {{ json_decode($order->shipping_address)->phone }}</small>
                            </td>
                            <td>
                                {{ $order->payment_type }}
                            </td>
                            <td>
                                {{ $order->payment_status }}
                            </td>
                            <td>
                                {{ $order->grand_total }}
                            </td>
{{--                            <td>--}}
{{--                                {{ $order->grand_total }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                @if ($order->user_id != null)--}}
{{--                                    {{ $order->user->name }}--}}
{{--                                @else--}}
{{--                                    Guest ({{ $order->guest_id }})--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ single_price($order->orderDetails->where('seller_id', $admin_user_id)->sum('price') + $order->orderDetails->where('seller_id', $admin_user_id)->sum('tax')) }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                @php--}}
{{--                                    $status = $order->orderDetails->first()->delivery_status;--}}
{{--                                @endphp--}}
{{--                                {{ ucfirst(str_replace('_', ' ', $status)) }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <span class="badge badge--2 mr-4">--}}
{{--                                    @if ($order->orderDetails->where('seller_id',  $admin_user_id)->first()->payment_status == 'paid')--}}
{{--                                        <i class="bg-green"></i> Paid--}}
{{--                                    @else--}}
{{--                                        <i class="bg-red"></i> Unpaid--}}
{{--                                    @endif--}}
{{--                                </span>--}}
{{--                            </td>--}}
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('driver.delivered',$order->id)}}">Delivered</a></li>
                                        <li><a href="#">Reject</a></li>
{{--                                        <li><a onclick="confirm_modal('{{route('orders.destroy', $order->id)}}');">{{__('Delete')}}</a></li>--}}
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $orders->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script>
@endsection
