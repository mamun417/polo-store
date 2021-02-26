@extends('admin.layouts.app')
@section('title', 'orders')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.orders.index') }}">Orders</a>
                </li>
                <li class="active">
                    <strong>Index</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.orders.index')}}" method="get"
                                      role="form">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="perPage" class="control-label">Records Per Page</label>
                                                </div>
                                                <div class="col-md-4 pr-0 responsive_p_r_15">
                                                    <select name="perPage" id="perPage" onchange="submit()"
                                                            class="input-sm form-control custom_field_height">
                                                        <option value="10"{{ request('perPage') == 10 ? ' selected' : '' }}>
                                                            10
                                                        </option>
                                                        <option value="25"{{ request('perPage') == 25 ? ' selected' : '' }}>
                                                            25
                                                        </option>
                                                        <option value="50"{{ request('perPage') == 50 ? ' selected' : '' }}>
                                                            50
                                                        </option>
                                                        <option value="100"{{ request('perPage') == 100 ? ' selected' : '' }}>
                                                            100
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 pl-sm-1 pr-sm-1 responsive_p_t_f_5">
                                                    <div class="float-left input-group">
                                                        <input name="keyword" type="text" value="{{ request('keyword') }}"
                                                               class="input-sm form-control" placeholder="Search Here">
                                                        <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-sm btn-primary custom_field_height"> Go!</button>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 p-0 responsive_p_l_15">
                                                <span>
                                                    <a href="{{ route('admin.orders.index') }}"
                                                       class="btn btn-default btn-sm custom_field_height">Reset
                                                    </a>
                                                </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="table-responsive m-t-md">
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
                                        <td class="text-left">${{ ucfirst(@$order->shipping_charge) }}</td>
                                        <td class="text-left">${{ ucfirst(@$order->tax) }}</td>
                                        <td class="text-left">${{ @$order->sub_total }}</td>
                                        <td class="text-left">${{ @$order->grand_total }}</td>

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
                                <div class="text-center">No records</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
