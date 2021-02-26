@extends('layouts.app')
@section('title', 'Payment Page')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/payment.css') }}">
@endpush

@section('content')
    <!-- Payment Area start -->
    <section class="payment-area" style="background-color: #dee1f0 !important">
        <section class="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="payment_main_text">
                            <h1>Select Payment Method</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <ul class="tabs-nav">
                            <li class="">
                                <a href="#tab-1" rel="nofollow">
                                    <img src="{{ asset('frontend/assets/images/paypal.svg') }}" class="p-2" alt="">
                                </a>
                            </li>
{{--                            <li class="tab-active">--}}
{{--                                <a href="#tab-2" rel="nofollow">--}}
{{--                                    <svg viewBox="0 0 60 25" xmlns="http://www.w3.org/2000/svg" width="50%" height="auto" class="UserLogo variant-- "><title>Stripe logo</title><path fill="var(--userLogoColor, #0A2540)" d="M59.64 14.28h-8.06c.19 1.93 1.6 2.55 3.2 2.55 1.64 0 2.96-.37 4.05-.95v3.32a8.33 8.33 0 0 1-4.56 1.1c-4.01 0-6.83-2.5-6.83-7.48 0-4.19 2.39-7.52 6.3-7.52 3.92 0 5.96 3.28 5.96 7.5 0 .4-.04 1.26-.06 1.48zm-5.92-5.62c-1.03 0-2.17.73-2.17 2.58h4.25c0-1.85-1.07-2.58-2.08-2.58zM40.95 20.3c-1.44 0-2.32-.6-2.9-1.04l-.02 4.63-4.12.87V5.57h3.76l.08 1.02a4.7 4.7 0 0 1 3.23-1.29c2.9 0 5.62 2.6 5.62 7.4 0 5.23-2.7 7.6-5.65 7.6zM40 8.95c-.95 0-1.54.34-1.97.81l.02 6.12c.4.44.98.78 1.95.78 1.52 0 2.54-1.65 2.54-3.87 0-2.15-1.04-3.84-2.54-3.84zM28.24 5.57h4.13v14.44h-4.13V5.57zm0-4.7L32.37 0v3.36l-4.13.88V.88zm-4.32 9.35v9.79H19.8V5.57h3.7l.12 1.22c1-1.77 3.07-1.41 3.62-1.22v3.79c-.52-.17-2.29-.43-3.32.86zm-8.55 4.72c0 2.43 2.6 1.68 3.12 1.46v3.36c-.55.3-1.54.54-2.89.54a4.15 4.15 0 0 1-4.27-4.24l.01-13.17 4.02-.86v3.54h3.14V9.1h-3.13v5.85zm-4.91.7c0 2.97-2.31 4.66-5.73 4.66a11.2 11.2 0 0 1-4.46-.93v-3.93c1.38.75 3.1 1.31 4.46 1.31.92 0 1.53-.24 1.53-1C6.26 13.77 0 14.51 0 9.95 0 7.04 2.28 5.3 5.62 5.3c1.36 0 2.72.2 4.09.75v3.88a9.23 9.23 0 0 0-4.1-1.06c-.86 0-1.44.25-1.44.9 0 1.85 6.29.97 6.29 5.88z" fill-rule="evenodd"></path></svg>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="">--}}
{{--                                <a href="#tab-3" rel="nofollow">--}}
{{--                                    <img src="{{ asset('frontend/assets/images/gpay.svg') }}"--}}
{{--                                             class="p-2" alt=""--}}
{{--                                             style="width: 65%; margin: auto;"--}}
{{--                                    >--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li class="">
                                <a href="#tab-4" rel="nofollow">
                                    <img src="{{ asset('frontend/assets/images/credit-card.svg') }}"
                                         class="p-2" alt=""
                                         style="width: 42%; margin: auto;"
                                    >
                                </a>
                            </li>
                        </ul>
                        <div class="tabs-stage">
                            <div id="tab-1" style="display: none;">
                                <p>
                                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and
                                </p>
                            </div>
{{--                            <div id="tab-2" style="display: block;">--}}
{{--                                <p>--}}
{{--                                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div id="tab-3" style="display: block;">--}}
{{--                                <p>--}}
{{--                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum--}}
{{--                                </p>--}}
{{--                            </div>--}}
                            <div id="tab-4" style="display: block;">
                                <p>
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sum">
                            <div class="sum_main">
                                <h2>Order Summary</h2>
                            </div>
                            <div class="subtotal d-flex justify-content-between">
                                <div class="subtotal_text">Subtotal</div>
                                <div class="subtotal_price">${{ @$order->sub_total }}</div>
                            </div>
                            <div class="subtotal d-flex justify-content-between">
                                <div class="subtotal_text">Shipping Charge</div>
                                <div class="subtotal_price">${{  @$order->shipping_charge }}</div>
                            </div>

                            <div class="subtotal d-flex justify-content-between">
                                <div class="subtotal_text">Tax</div>
                                <div class="subtotal_price">${{  @$order->tax }}</div>
                            </div>
                            <div class="total d-flex justify-content-between">
                                <div class="total_text">Total Amount</div>
                                <div class="total_price">${{ @$order->grand_total }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Payment Area end -->
@endsection

@push('script')
    <script>
        // Change tab class and display content
        $('.tabs-nav a').on('click', function (event) {
            event.preventDefault();

            $('.tab-active').removeClass('tab-active');
            $(this).parent().addClass('tab-active');
            $('.tabs-stage div').hide();
            $($(this).attr('href')).show();
        });

        $('.tabs-nav a:first').trigger('click'); // Default
    </script>
@endpush
