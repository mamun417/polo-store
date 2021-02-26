@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <!-- Slide Area Start-->
    <div class="slider-section">
        <!--        <div class="row">-->

        <!-- <img class="header-img" src="assets/img/WEB-04.jpg" alt=""> -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach(@$sliders as $key => $slider)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ @$key }}" class=""></li>
                @endforeach
            </ol>
            <div class="carousel-inner">

                @foreach(@$sliders as $k => $slider)
                    <div class="carousel-item {{ @$k === 0 ? 'active' : ''}}">
                        <img src="{{ @$slider->image->url }}" class="d-block w-100 slider-img"
                             alt="{{ @$slider->title }}">
                    </div>
                @endforeach

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!--        </div>-->
    </div>
    <!-- Slide Area End-->

    <!--
        &lt;!&ndash; SHOP Area Start&ndash;&gt;
        <section class=" section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-area">
                            <div class="shop-area-content">
                                <h3 class="shop-area-content_subtitle">
                                    The IONIC
                                </h3>
                                <h2 class="shop-area-content_name">JACKET</h2>
                                <a href="">
                                    <h4 class="feature-items_shop"> Shop Now</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        &lt;!&ndash; SHOP Area Endt&ndash;&gt;
    -->

    <!-- Featuring Area Start-->
    <section class="featuring-area section-padding">
        <div class="container">
            <div class="row">
                <h3 class="section-title"> Featuring</h3>
            </div>

            @if (count(@$feature_products))
                <div class="row">
                    @foreach(@$feature_products as $feature_product)
                    <!-- style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2)"; -->
                        <div class="col-lg-4 col-md-6">
                            <div class="feature-items" >
                                <a href="{{ route('products.details', @$feature_product->slug) }}">
                                    <img class="feature-items_img" src="{{ @$feature_product->images()->first()->url }}"
                                         alt="">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <div class="product-details-area">
                                        <div class="product-name-area">
                                            <h5
                                                class="feature-items_name"
                                                title="{{ @$feature_product->name }}"
                                            >
                                                {{ ucfirst(Str::limit(@$feature_product->name, 10)) }}
                                            </h5>
                                            <h5 class="feature-items_status">On Sale</h5>
                                        </div>
                                        <div class="product-price-area">
                                            <div class="price-area d-flex">
                                                <span class="feature-items_from">From</span>
                                                @if(@$feature_product->price)
                                                    @if (@$feature_product->discount_price)
                                                        <p class="feature-items_price">{{ @$feature_product->discount_price }}</p>
                                                        <span class="mt-2"><del>${{ @$feature_product->price }}</del></span>
                                                    @else
                                                        <p class="feature-items_price">{{ @$feature_product->price }}</p>
                                                    @endif
                                                @elseif(@$feature_product->productPricesWithSize()->first()->price)
                                                    @php(@$product_size = @$feature_product->productPricesWithSize()->first())
                                                    @if (@$product_size->discount_price)
                                                        <p class="feature-items_price">{{ @$product_size->discount_price }}</p>
                                                        <span class="mt-2"><del>${{ @$product_size->price }}</del></span>
                                                    @else
                                                        <p class="feature-items_price">{{ @$product_size->price }}</p>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </a>
                            @php($offer = ($feature_product->offers)->first())
                            {{--                                {{ dump($offer) }}--}}
                            @if(isset($offer) && $offer->status && !in_array($feature_product->id, $session_decline_product) && !in_array($offer->id, $already_applied_offer_ids)) <!-- 1 = active-->
                                <h4 class="feature-items_shop"
                                    data-offerId="{{ $feature_product->offers()->first()->id }}"
                                    data-productId="{{ $feature_product->id }}"
                                    data-productSlug="{{ $feature_product->slug }}"
                                    onclick="showProductOfferModal(this)">
                                    Shop Now
                                </h4>
                                @else
                                    <div class="product_details_and_rating">
                                        <div class="row">
                                            <div class="pr-0 col-6">
                                                <div class="home_product_rating">
                                                    @include('includes.product-rating.average-rating', @$productRating = @$feature_product)
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <a href="{{ route('products.details', @$feature_product->slug) }}">
                                                    <h5 class="feature-items_shop">View Details</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-5 text-right justify-content-end">
                    <div class="col-lg-3">
                        {{ @$feature_products->appends(['keyword' => request('keyword')])->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-warning w-100 ml-4">There are no products</div>
            @endif
        </div>
    </section>
    <!-- Featuring Area End-->




    <!-- Session essential Start-->
    {{--    <section class="session-area section-padding">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <h3 class="section-title"> Essentials of the Session </h3>--}}
    {{--            </div>--}}
    {{--            <div class="row justify-content-center">--}}
    {{--                <div class="col-lg-4 col-md-6">--}}
    {{--                    <div class="session-items-1 mt-4">--}}
    {{--                        <img class="session-items" src="{{ asset('frontend/assets/images/nav-1.png') }}" alt="">--}}
    {{--                        <h4 class="session-items_subtitle">Light-Weight</h4>--}}
    {{--                        <h4 class="session-items_name">TIES</h4>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-4 col-md-6">--}}
    {{--                    <div class="session-items-1 mt-4">--}}
    {{--                        <img class="session-items" src="{{ asset('frontend/assets/images/nav-1.png') }}" alt="">--}}
    {{--                        <h4 class="session-items_subtitle">Light-Weight</h4>--}}
    {{--                        <h4 class="session-items_name">TIES</h4>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-4 col-md-6">--}}
    {{--                    <div class="session-items-1 mt-4">--}}
    {{--                        <img class="session-items" src="{{ asset('frontend/assets/images/nav-1.png') }}" alt="">--}}
    {{--                        <h4 class="session-items_subtitle">Light-Weight</h4>--}}
    {{--                        <h4 class="session-items_name">TIES</h4>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <!-- Session essential End-->

    <!-- single products Modal -->
    <div class="modal fade " id="productOfferModal" tabindex="-1" aria-labelledby="productOfferModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-width">
            <div class="modal-content p-0">
                <div class="modal-body p-0">
                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-6 p-0">
                            <div class="img-right-border">
                                <img id="productOfferImage" src="" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-form-area pb-0">
                                <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="">
                                <p class="dont-forget">Dont Forget</p>
                                <h4 class="discount-parcent"> TAKE <span
                                        id="productOfferDiscountPercentage"> 15% </span> OFF </h4>
                                <span>your first purchase</span>
                                <form action="{{ route('offers.save-for-later') }}" method="post" id="productOfferForm">
                                    @csrf
                                    <input type="email" class="form-control"
                                           value="{{ auth()->user()->email ?? '' }}"
                                           name="email" id="email" required="required" autofocus
                                           placeholder="Email Address">
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="hidden" name="offer_id" id="productOfferId">
                                    <input type="hidden" name="product_id" id="productOfferOfProductId">

                                    <a href="javascript:void(0)"
                                       onclick="event.preventDefault(); document.getElementById('productOfferForm').submit()">
                                        <h4 class="feature-items_shop offer btn-back-off"> Save <span
                                                id="productOfferBackPercentage"> 15% </span> Off For Later</h4>
                                    </a>
                                    <a href="javascript:void(0)" id="productOfferApplyNow">
                                        <h4 class="feature-items_shop offer"> Apply <span
                                                id="productOfferUnlimitedPercentage"> 15% </span> Now</h4>
                                    </a>
                                </form>
                                <p><a id="productOfferDecline" href="javascript:void(0)">Decline Offer</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        function showProductOfferModal(element) {
            event.preventDefault()
            let offer_id = $(element).data('offerid');
            let product_id = $(element).data('productid');
            let product_slug = $(element).data('productslug');

            let url = "{{ route('products.get.offers', '') }}/" + product_id
            let product_details_url = "{{ route('products.details', '') }}/" + product_slug + '?offerId=' + offer_id
            let offer_decline_url = "{{ route('user.offers-decline', '') }}/" + product_id
            axios.get(url)
                .then(res => {
                    $("#productOfferImage").attr('src', res.data.image)
                    $("#productOfferDiscountPercentage").text(res.data.offer_percentage + '%')
                    $("#productOfferUnlimitedPercentage").text(res.data.offer_percentage + '%')
                    $("#productOfferBackPercentage").text(res.data.offer_percentage + '%')
                    $("#productOfferApplyNow").attr('href', product_details_url)
                    $("#productOfferId").val(offer_id)
                    $("#productOfferDecline").attr('href', offer_decline_url)
                    $("#productOfferOfProductId").val(product_id)
                    $("#productOfferModal").modal('show')
                })
                .catch(error => console.log(error.response))
        }
    </script>
@endpush

