@extends('layouts.app')
@section('title', 'Shopping Cart')

@section('content')
    <!-- cart area start -->
    <div class="container">
        <div class="row justify-content-end mb-5">
            @if (Cart::instance('cart')->content()->count())
                <div class="col-lg-12">
                    <div class="cart-table-area card">
                        <div class="section-title card-header pb-0">
                            <h5>Your Cart Items</h5>
                        </div>

                        <div class="table-responsive">
                            <table id="cart-table"
                                   class="table table-striped text-center" style="overflow-x: visible;">
                                <thead>
                                <tr>
                                    <th class="w-10">Image</th>
                                    <th class="w-35">Title</th>
                                    <th class="w-10">Price</th>
                                    <th class="w-15">Quantity</th>
                                    <th class="w-10">Tax</th>
                                    <th class="w-10">Amount</th>
                                    <th class="w-10">Actions</th>
                                </tr>
                                </thead>

                                <tbody class="cart-detail">
                                @foreach(@$cart_products as $product)
                                    <tr class="cart-items">
                                        <td class="item-thumbnail">
                                            <img src="{{ @$product->options['image'] }}"
                                                 alt="Bean Burrito" class="cart-detail-img">
                                        </td>

                                        <td class="item-title">
                                            <h3 class="product-title">{{ @$product->name }}</h3>
                                            <p class="text-muted product-subtitle">
                                                @if (@$product->options['color'])
                                                    Color: {{ @$product->options['color'] }}<br>
                                                @endif

                                                @if (@$product->options['size'])
                                                    Size: {{ @$product->options['size'] }}
                                                @endif

                                                @if (@$product->options['offer_amount'])
                                                    Offer: {{ getCurrencyIcon() .  @$product->options['offer_amount'] * @$product->qty }}
                                                @endif
                                            </p>
                                        </td>

                                        <td class="item-price">
                                            ${{ @$product->price }}
                                        </td>

                                        <td class="item-quantity">
                                            <span class="quantity">
                                                <form action="{{ route('cart.update.qty', @$product->rowId) }}"
                                                      method="post"
                                                      class="form-inline d-block">
                                                    @csrf

                                                    <input value="{{ @$product->qty }}" type="number" name="qty"
                                                           class="form-control-sm w-25" min="1">
                                                    <button type="submit" class="btn btn-sm btn-success"><i
                                                            class="fa fa-check"></i></button>
                                               </form>

                                                @error('qty')
                                                <div class="text-danger">{{ @$message }}</div>
                                                @enderror

                                            </span>
                                        </td>

                                        <td class="item-total">
                                            {{ number_format(@$product->taxRate, 2) }} %
                                        </td>

                                        <td class="item-total">
                                            {{ getCurrencyIcon() . number_format(@$product->subtotal, 2) }}
                                        </td>

                                        <td class="item-aciton p-0">
                                        <span class="action">
                                            <a href="{{ route('cart.remove', @$product->rowId) }}" type="button"
                                               class="btn btn-sm btn-danger">
												x
											</a>
                                            <a href="{{ route('products.details', @$product->options['slug'])."?cart=".@$product->rowId }}"
                                               class="btn btn-sm btn-info">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true">
                                                </i>
                                            </a>
                                        </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <a href="{{ route('home') }}" class="btn btn-primary mt-4">Continue to shipping</a>
                </div>
                <div class="col-lg-6">
                    <div class="cart-summary card mt-4">
                        <div class="section-title card-header pb-0 d-flex justify-content-between">
                            <h5>Cart Total</h5>
                            <div class="mr-1">
                                <a href="javascript:void(0)" type="button"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure that you empty shopping cart ?')
                                       ? window.location='{{ route('cart.empty') }}'
                                       : ''">
                                    Empty Cart
                                </a>
                            </div>

                        </div>
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td class="subtotal text-right">
                                    {{ getCurrencyIcon() . Cart::instance('cart')->subtotalFloat() }}
                                </td>
                            </tr>
                            <tr>
                                <td>Total Tax</td>
                                <td class="delivery-fee text-right">
                                    {{ getCurrencyIcon() . number_format(Cart::instance('cart')->taxFloat(), 2) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <th class="total text-right" style="font-weight: bold;">
                                    {{ getCurrencyIcon() . Cart::instance('cart')->totalFloat() }}
                                </th>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2" class="text-center">
                                    @if(Cart::instance('cart')->count() > 0)
                                        <a href="{{ route('cart.checkout') }}" class="btn btn-success">
                                            Proceed to Checkout
                                        </a>
                                    @endif
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @else
                <div class="col-lg-12 mb-5 mt-5">
                    <div class="alert alert-danger">
                        <strong>Your cart is empty, You should go to <a href="{{ route('home') }}">
                                shopping
                                page </a>
                        </strong>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- cart area end -->

    <!-- interested Items start-->
    <!--    <section class="interested-items-area">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <h4 class="interested-title">YOU MAY ALSO BE INTERESTED IN</h4>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="interested-items">
                            <img src="assets/images/nav-1.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="interested-items">
                            <img src="assets/images/nav-1.png" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="interested-items">
                            <img src="assets/images/nav-1.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="interested-items">
                            <img src="assets/images/nav-1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
    <!-- interested Items end-->
@endsection
