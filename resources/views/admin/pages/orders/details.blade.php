@extends('admin.layouts.app')
@section('title', 'Order Details')

@section('content')
    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Orders</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Orders Details</strong>
                </li>
            </ol>
            <a class="btn btn-sm btn-primary pull-right m-t-n-md boardCreateModalShow"
               href="{{ route('admin.orders.index') }}">
                <i class="fa fa-arrow-left"></i> <strong>Back</strong>
            </a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>User Details</h5>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ @$order->user->name }}</td>
                                <td>{{ @$order->user->email }}</td>
                                <td>{{ @@$order->user->phone }}</td>
                                <td>{{ @@$order->user->address }}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ibox-title">
                                <h5>Change Order Status</h5>
                            </div>
                            <div class="ibox-content">
                                <form action="{{ route('admin.orders.change-status',@$order->id) }}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <select name="status" class="form-control-sm form-control input-s-sm inline">
                                            @foreach(\App\Models\Order::ORDER_STATUS as $key => $status)
                                                <option
                                                    {{ @$order->order_status === @$key  ? 'selected' : '' }} value="{{ @$key }}">{{ ucfirst(@$status) }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-append">
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </span>
                                    </div>
                                </form>
                                <h3 class="mt-4">
                                    <span class="badge badge-{{ \App\Models\Order::ORDER_STATUS_COLOR[@$order->order_status] }}">{{ \App\Models\Order::ORDER_STATUS[@$order->order_status] }}</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ibox-title">
                                <h5>Change Payment Status</h5>
                            </div>
                            <div class="ibox-content">
                                <form action="{{ route('admin.orders.change-payment-status', @$order->id) }}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <select name="payment_status" class="form-control-sm form-control input-s-sm inline">
                                            <option value="">Choose Payment Status</option>
                                            <option value="0">Unpaid</option>
                                            <option value="1">Paid</option>
                                        </select>
                                        <span class="input-group-append">
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </span>
                                    </div>
                                    @error('payment_status')
                                        <p class="text text-danger">{{ @$message }}</p>
                                    @enderror
                                </form>
                                <h3 class="mt-4">
                                    <span class="badge badge-{{ @$order->payment_status  == 0  ? 'danger' : 'success' }}">{{ \App\Models\Order::PAYMENT_STATUS[@$order->payment_status] }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Shipping Details</h5>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Zipcode</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ @$order->user->shippingAddress->first_name . ' '. @$order->user->shippingAddress->last_name }}</td>
                                <td>{{ @$order->user->shippingAddress->email }}</td>
                                <td>{{ @$order->user->shippingAddress->country }}</td>
                                <td>{{ @$order->user->shippingAddress->state }}</td>
                                <td>{{ @$order->user->shippingAddress->city }}</td>
                                <td>{{ @$order->user->shippingAddress->zipcode }}</td>
                                <td>{{ @$order->user->shippingAddress->phone }}</td>
                                <td>{{ @$order->user->shippingAddress->address }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Details</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Size</th>
                                    <th>Product Color</th>
                                    <th>Ordered Qty</th>
                                    <th>Available Qty</th>
                                    <th>Product Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(@$order->orderDetails as $details)
                                    <tr>
                                        <td>{{ @$details->product->name }}</td>
                                        <td>{{ @$details->product_size ?? 'N/A' }}</td>
                                        <td>{{ @$details->product_color ?? 'N/A' }}</td>
                                        <td>{{ @$details->product_quantity }}</td>
                                        <td>
                                            @if(\App\Http\Controllers\Helpers\ProductHelper::productExistQty(@$details->product_id, @$details->product_size) > 0)
                                                <span class="badge badge-success">{{ \App\Http\Controllers\Helpers\ProductHelper::productExistQty(@$details->product_id, @$details->product_size) }}</span>
                                            @else
                                                <span class="badge badge-danger">Stock Out</span>
                                            @endif
                                        </td>
                                        <td>@${{ @$details->product_price }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>SUB TOTAL :</strong></td>
                                    <td>@${{ number_format(@$order->sub_total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>SHIPPING CHARGE :</strong></td>
                                    <td>@${{ number_format(@$order->shipping_charge, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>TAX :</strong></td>
                                    <td>@${{ number_format(@$order->tax, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>GRAND TOTAL :</strong></td>
                                    <td>@${{ number_format(@$order->grand_total, 2) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
