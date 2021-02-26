@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
    <!-- Payment Area start -->
    <section class="payment-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="assets/images/logo.png" class="checkout-logo" alt="">
                </div>
            </div>
            <div class="row resp-direction">
                <div class="col-lg-6 col-md-6 border-right pr-5">
                    <div class="left-area">
                        <div class="row">
                            <div class="col-lg-12">
                                <nav aria-label="breadcrumb" class="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Cart</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="payment-methods address-area">
                            <table style="width: 100%;">
                                <tr>
                                    <td>Contact</td>
                                    <td>{{ auth()->user()->shippingAddress->email ?? 'N/A' }}</td>
                                    <td class="text-right"><a href="{{ route('cart.checkout') }}">Change</a></td>
                                </tr>
                                <tr>
                                    <td>Ship to</td>
                                    <td>{{ auth()->user()->shippingAddress->address ?? 'N/A' }}</td>
                                    <td class="text-right"><a href="{{ route('cart.checkout') }}">Change</a></td>
                                </tr>
                            </table>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-form-area">
                                    @if(@$shipping_methods->count())
                                        <h4>Shipping Method</h4>
                                    @endif
                                    <form action="{{ route('cart.order.store') }}" method="post">
                                        @csrf
                                        <ul class="list-group">
                                            @foreach(@$shipping_methods as $method)
                                                <li class="list-group-item d-flex  justify-content-between align-items-center">
                                                    <input value="{{ @$method->id }}"
                                                           data-charge="{{ @$method->charge }}"
                                                           class="form-check-input changeShippingMethod"
                                                           id="shipping_method" type="radio"
                                                           name="shipping_method">
                                                    {{ @$method->title }} : ${{ @$method->applicable_amount }} +
                                                    <span>{{ @$method->charge !== 0 ? '$'.@$method->charge : 'Free' }}</span>
                                                </li>
                                            @endforeach
                                        </ul>

                                        @error('shipping_method')
                                        <span class="help-block m-b-none text-danger">
                                            {{ @$message }}
                                        </span>
                                        @enderror

                                        <div class="row">
                                            <div
                                                class="col-lg-12 d-flex justify-content-end align-items-center mt-3 mb-2">
                                                <button type="submit" class="btn shiping-btn btn-primary ">Continue to
                                                    payment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 pl-5">
                    <div class="right-area">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-area">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p>subtotal</p>
                                        <p> ${{ Cart::instance('cart')->subtotal() }}</p>
                                    </div>
                                    @if(@$shipping_methods->count())
                                        <div class="d-flex my-2 justify-content-between align-items-center">
                                            <p class="m-0 phone-icon">Shipping Charge</p>
                                            <a class="m-0 ShippingCharge" href="#">$0.00</a>
                                        </div>
                                    @endif

                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="m-0 phone-icon">Total Tax</p>
                                        <a class="m-0"
                                           href="javascript:void(0)">${{ number_format(Cart::instance('cart')->tax(), 2) }}</a>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3>Total</h3>
                                        <div class="total-price">
                                            <h3 id="cartGrandTotal">${{ Cart::instance('cart')->totalFloat() }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Payment Area end -->
@endsection

@push('script')
    <script>
        $().ready(function () {
            $(".changeShippingMethod").each(function () {
                $(this).on('change', function () {
                    let charge = $(this).data('charge');
                    let cartTotal = "{{ Cart::instance('cart')->totalFloat() }}"
                    let inTotal = parseFloat(charge) + parseFloat(cartTotal)
                    $(".ShippingCharge").text('$' + charge)
                    $("#cartGrandTotal").text('$'+ parseFloat(inTotal))
                })
            })
        })
    </script>
@endpush
