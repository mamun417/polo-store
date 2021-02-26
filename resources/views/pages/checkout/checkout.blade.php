@extends('layouts.app')
@section('title', 'Payment')

@section('content')
    <!-- Payment Area start -->
    <section class="payment-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="{{ asset('frontend/assets/images/logo.png') }}" class="payment-logo" alt="">
                </div>
            </div>
            <div class="row resp-direction">
                <div class="col-lg-6 col-md-6 border-right payment-right-gap">
                    <div class="left-area">
                        <div class="row">
                            <div class="col-lg-12">
                                <nav aria-label="breadcrumb" class="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Cart</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        @guest
                            <div class="payment-methods">
                                <div class="row text-center">
                                    <div class="col-lg-6 padding-r">
                                        <a href="javascript:void(0)" data-toggle="modal" data-dismiss="modal"
                                           data-target="#signUpModal">
                                            Register
                                        </a>
                                    </div>
                                    <div class="col-lg-6 padding-l">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                                            Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{--                        <h4 class="payment-title"><span>OR</span></h4>--}}
                        @endguest
                        @auth
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="payment-form-area">
                                        <form action="{{ route('cart.shipping.store') }}" method="post">
                                            @csrf
                                            <!--
                                            <div class="d-flex justify-content-between align-items-center">
                                            <p class="form-title">Contact Informatoin</p>
                                            <div>
                                            <p class="d-inline mr-1">Already have an account?</p>
                                            <a href=""> Log in</a>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email" id="email">
                                            </div>
                                            <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Keep me up to date on new and exclusive
                                            offers</label>
                                            </div>
                                            -->
                                            <p class="form-title">Shiping Address</p>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" name="first_name" value="{{ auth()->user()->shippingAddress->first_name ?? '' }}" class="form-control"
                                                               placeholder="First Name">
                                                        @error('first_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" name="last_name" value="{{ auth()->user()->shippingAddress->last_name ?? '' }}" class="form-control" placeholder="Last Name">
                                                        @error('last_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <div class="form-group">--}}
{{--                                                <input type="text" value="{{ auth()->user()->shippingAddress->first_name ?? '' }}" class="form-control" placeholder="Company(Optional)">--}}
{{--                                            </div>--}}

                                            <div class="form-group">
                                                <input type="text" name="email" value="{{ auth()->user()->shippingAddress->email ?? '' }}" class="form-control" placeholder="Email">
                                                @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group phone-icon">
                                                <input type="tel" name="phone" value="{{ auth()->user()->shippingAddress->phone ?? '' }}" class="form-control " placeholder="Phone">
                                                @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="city" value="{{ auth()->user()->shippingAddress->city ?? '' }}" class="form-control" placeholder="City">
                                                @error('city')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="state" value="{{ auth()->user()->shippingAddress->state ?? '' }}" class="form-control" placeholder="State">
                                                @error('state')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="address" value="{{ auth()->user()->shippingAddress->address ?? '' }}" class="form-control" placeholder="Address">
                                                @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
<!--                                            <div class="row">
                                                <div class="col-lg-4 pr-0">
                                                    <div class="form-group">
                                                        <select class="form-control select-border">
                                                            <option value="country">Country/Region</option>
                                                            <option value="united">United State</option>
                                                            <option value="opel">Opel</option>
                                                            <option value="audi">Audi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 pr-0">
                                                    <div class="form-group">
                                                        <select class="form-control select-border">
                                                            <option value="country">Country/Region</option>
                                                            <option value="united">United State</option>
                                                            <option value="opel">Opel</option>
                                                            <option value="audi">Audi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <select class="form-control select-border">
                                                            <option value="country">Country/Region</option>
                                                            <option value="united">United State</option>
                                                            <option value="opel">Opel</option>
                                                            <option value="audi">Audi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <div class="row">
                                                <div class="col-lg-12 text-right">
                                                    <button type="submit" class="btn btn-primary">
                                                        Continue to Payment
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="d-block mb-4">
                                                <i class="fa fa-angle-left mr-1" aria-hidden="true"></i>
                                                <a class="return-cart" href="{{ route('cart.index') }}"> Return to
                                                    cart</a>
                                            </div>
                                            {{--                                        <div class="discount-area">--}}
                                            {{--                                            <div class="form-group form-check">--}}
                                            {{--                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
                                            {{--                                                <label class="form-check-label" for="exampleCheck1">Get 20% off your--}}
                                            {{--                                                    order</label>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <p class="m-0 font-weight-bold pl-3 offer-desc">Lorem Ipsum is simply dummy--}}
                                            {{--                                                text of the</p>--}}
                                            {{--                                            <p class="mt-0 pl-3 offer-desc">Lorem Ipsum is simply dummy text of the--}}
                                            {{--                                                printing and typesetting--}}
                                            {{--                                                industry. Lorem Ipsum has been the industry's standard--}}
                                            {{--                                                dummy</p>--}}
                                            {{--                                        </div>--}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 payment-left-gap">
                    <div class="right-area">
{{--                        <form action="">--}}
{{--                            <div class="row mt-4">--}}
{{--                                <div class="col-lg-10">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="text" class="form-control" placeholder="Discount Code">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-2 pl-0">--}}
{{--                                    <button class="btn btn-secondary form-control">Apply</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-area">
{{--                                    <p class="verify-text">Verification by ID.me <a href="#">What is ID.me?</a></p>--}}
{{--                                    <hr>--}}
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p>subtotal</p>
                                        <p> ${{ Cart::instance('cart')->subtotal() }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="m-0 phone-icon">Total Tax</p>
                                        <a class="m-0" href="javascript:void(0)">  ${{ number_format(Cart::instance('cart')->tax(), 2) }}</a>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3>Total</h3>
                                        <div class="total-price">
                                            <span class=" currency">USD</span>
                                            <h3> ${{ Cart::instance('cart')->totalFloat() }}</h3>
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
            let auth = '{{ auth()->check() }}'
            if (!auth) {
                $("#loginModal").modal('show')
            }
        })
    </script>
@endpush
