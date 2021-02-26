@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="widget style1 red-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-usd fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right pl-0">
                                        <span> Total Sale </span>
                                        <h3 class="font-bold">{{ number_format(@$totalSale, 2) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget style1 yellow-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-usd fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right pl-0">
                                        <span> Today Sale </span>
                                        <h3 class="font-bold">{{ number_format(@$today_sale, 2) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-file-text-o fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right pl-0">
                                        <span> Total Order </span>
                                        <h3 class="font-bold">{{ number_format(@$totalOrder, 2) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget style1 navy-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-archive fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right pl-0">
                                        <span> Total Product </span>
                                        <h3 class="font-bold">{{ number_format(@$totalProduct) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget style1 black-bg text-light">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right pl-0">
                                        <span> Total Customer </span>
                                        <h3 class="font-bold">{{ number_format(@$totalCustomer) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Latest Orders List </h5>
                </div>
                <div class="ibox-content">
                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-sm-9 m-b-xs">--}}
                    {{--                            <div data-toggle="buttons" class="btn-group btn-group-toggle">--}}
                    {{--                                <label class="btn btn-sm btn-white active"> <input type="radio" id="option1"--}}
                    {{--                                                                                   name="options"> Day </label>--}}
                    {{--                                <label class="btn btn-sm btn-white"> <input type="radio" id="option2" name="options">--}}
                    {{--                                    Week </label>--}}
                    {{--                                <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options">--}}
                    {{--                                    Month </label>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-sm-3">--}}
                    {{--                            <div class="input-group mb-3">--}}
                    {{--                                <input type="text" class="form-control form-control-sm" placeholder="Search">--}}
                    {{--                                <div class="input-group-append">--}}
                    {{--                                    <button class="btn btn-sm btn-primary" type="button">Go!</button>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-left">User Name</th>
                                <th>Order Item</th>
                                <th class="text-left">Payment</th>
                                <th class="text-left">Shipping Charge</th>
                                <th class="text-left">Tax</th>
                                <th class="text-left">Sub-Total</th>
                                <th class="text-left">Grand-Total</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach(@$orders as $order)
                                <tr>
                                    <td class="text-left">{{ ucfirst(@$order->user->name) }}</td>
                                    <td class="text-center"><span
                                            class="badge badge-info">{{ @$order->orderDetails->count() }}</span></td>
                                    <td class="text-left">
                                        @if(@$order->payment_status === 1)
                                            <span
                                                class="badge badge-primary"> {{ ucfirst(\App\Models\Order::PAYMENT_STATUS[@$order->payment_status]) }}</span>
                                        @else
                                            <span
                                                class="badge badge-danger"> {{ ucfirst(\App\Models\Order::PAYMENT_STATUS[@$order->payment_status]) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-left">{{ getCurrencyIcon() . ucfirst(@$order->shipping_charge) }}</td>
                                    <td class="text-left">{{getCurrencyIcon() . ucfirst(@$order->tax) }}</td>
                                    <td class="text-left">{{getCurrencyIcon() . @$order->sub_total }}</td>
                                    <td class="text-left">{{getCurrencyIcon() . @$order->grand_total }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ \App\Models\Order::ORDER_STATUS_COLOR[@$order->order_status] }}">{{ ucfirst(\App\Models\Order::ORDER_STATUS[@$order->order_status]) }}</span>
                                    </td>
                                    <td>{{ @$order->created_at->diffforhumans() }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', @$order->id)  }}" title="Edit"
                                           class="btn btn-info btn-sm cus_btn">
                                            <i class="fa fa-info-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if (count(@$orders))
                            {{ @$orders->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}
                        @else
                            <div class="text-center">No orders found</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
