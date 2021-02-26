@extends('layouts.app')
@section('title', 'My Profile')

@push('style')
    <style>
        .topBorder {
            border-top: 2px solid #002A5C;
        }

        .form-control:focus {
            border-color: #002A5C !important;
            box-shadow: 0 0 0 0.2rem rgba(92, 184, 92, 0.25) !important;
        }

        .order-block table {
            width: 100%;
        }

        .order-block span {
            font-size: 14px;
        }

        table.item tr td {
            padding: 20px 5px !important;
            vertical-align: top;
        }

        .p-status {
            font-weight: 400;
            font-size: 12px !important;
        }

        .activeUserMenu {
            z-index: 2;
            color: #fff;
            background-color: #a8d8a8;
            border-color: #5d995f;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row mb-3 mt-xl-2 mt-lg-2 mt-md-3 mt-sm-3 mt-3">
            <div class="col-md-3">
                @include('pages.profile.includes.sidebar')
            </div>
            <div class="col-md-9">
                <div class="filter-block p-3 shadow table-responsive topBorder">
                    <table>
                        <tr>
                            <td><span class="pr-2">Show:</span></td>
                            <td>
                                <form action="{{ route('user.orders.index') }}">
                                    <select name="perPage" id="exampleFormControlSelect1" onchange="submit()"
                                            class="input-sm form-control custom_field_height">
                                        <option value="5"{{ request('perPage') == 5 ? ' selected' : '' }}>last 5 order
                                        </option>
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
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>

                @if (count(@$orders))
                    @foreach(@$orders as $order)
                        <div class="order-block p-3 shadow mt-4">
                            <table class="order">
                                <tr>
                                    <td>
                                        <span>Order</span> <span class="text-info">#{{ @$order->id }}</span>
                                        <span> - {{ getCurrencyIcon('usd') . @$order->grand_total }}</span>
                                        <br>
                                        <small>Placed
                                            on {{ @$order->created_at->isoFormat('Do MMM YYYY, h:mm:ss a') }}</small>
                                    </td>
                                    <td class="text-right">
                                        Payment Status : <span
                                            class="badge {{ @$order->payment_status == 0 ? ' badge-danger' : ' badge-success' }}">
                                             {{ \App\Models\Order::PAYMENT_STATUS[@$order->payment_status] }}
                                        </span>

                                        <!--check payment status is pending (0 = pending)-->
                                        @if (@$order->payment_status == 0)
                                            <a class="text-danger ml-3" href="{{ route('payment.page', @$order->id) }}">
                                                PAY NOW
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <hr class="my-2">
                            <table class="item">
                                @foreach(@$order->orderDetails as $detail)
                                    <tr class="">
                                        <td width="12%">
                                            <a class="text-dark"
                                               href="{{ route('products.details', @$detail->product->slug) }}">
                                                <img class="img-fluid"
                                                     src="{{ @$detail->product->images()->first()->url }}"
                                                     alt="{{ @$detail->product->name }}">
                                            </a>
                                        </td>
                                        <td width="40%">
                                            <div>
                                                <a class="text-dark"
                                                   href="{{ route('products.details', @$detail->product->slug) }}">
                                                    {{ @$detail->product->name }}
                                                </a>
                                                <div>Category : {{ @$detail->product->category->name }}</div>
                                                <div>Brand : {{ @$detail->product->brand->name }}</div>

                                                @if (@$color = @$detail->product_color)
                                                    <div>Color : {{ @$color }}</div>
                                                @endif

                                                @if (@$size = @$detail->product_size)
                                                    <div>
                                                        Size : {{ @$size }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td width="10%"><span
                                                class="text-secondary">Qty:</span> {{ @$detail->product_quantity }}
                                        </td>
                                        <td width="25%" class="text-right">
                                            <span
                                                class="badge badge-success"> Price => ${{ @$detail->product_price }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="text-right">
                                Order Status : <span
                                    class="badge badge-{{ \App\Models\Order::ORDER_STATUS_COLOR[@$order->order_status] }}">
                                    {{ \App\Models\Order::ORDER_STATUS[@$order->order_status] }}
                                </span>

                                <!--check order status is not complete (3 = complete)-->
                                @if (@$order->order_status !== 3 && @$order->order_status !== 4)
                                    <a onclick="deleteRow({{ @$order->id }})" href="JavaScript:void(0)"
                                       class="text-danger ml-3">
                                        CANCEL ORDER
                                    </a>
                                @endif

                                <form id="row-delete-form{{ @$order->id }}" method="POST" class="d-none"
                                      action="{{ route('order.cancel', @$order->id) }}">
                                    @csrf()
                                </form>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger mt-5">
                        <strong>
                            No order found in your account, You should go to <a href="{{ route('home') }}">
                                shopping page
                            </a>
                        </strong>
                    </div>
                @endif
                <br>
                {{ @$orders->appends(['perPage' => request('perPage')])->links() }}
            </div>
        </div>
    </div>
@endsection
