@extends('layouts.app')
@section('title', 'Products')

@section('content')
    <!-- cat product start -->
    <section class="cat-product section-padding pt-0">
        <div class="container">
            <div class="row mb-3 mt-3 mr-lg-0 justify-content-lg-end ml-sm-auto">
                <div class="col-lg-2 col-md-12  pr-0 pl-md-0">
                    <!--  Dropdown Area Start -->
                    <form action="">
                        <select name="sortBy" id="exampleFormControlSelect1" onchange="submit()"
                                class="input-sm form-control custom_field_height">
                            <option value="">Filter By</option>
                            <option value="name" {{ request('sortBy') == 'name' ? ' selected' : '' }}>
                                Name
                            </option>
                            <option value="color" {{ request('sortBy') == 'color' ? ' selected' : '' }}>
                                Color
                            </option>
                            <option value="price" {{ request('sortBy') == 'price' ? ' selected' : '' }}>
                                Price
                            </option>
                            <option value="feature" {{ request('sortBy') == 'feature' ? ' selected' : '' }}>
                                Feature
                            </option>
                            <option value="on_sale" {{ request('sortBy') == 'on_sale' ? ' selected' : '' }}>
                                On Sale
                            </option>
                        </select>
                    </form>
                    <!-- Dropdown Area End -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 pr-0">
                    <!--Sidebar Start-->
                @include('includes.sidebar.sidebar')
                <!--Sidebar End-->
                </div>

                <div class="col-lg-10">
                    <div class="row">
                        @if(@$products->count() > 0)
                            @foreach(@$products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-12 pr-0 mb-3">
                                    <a href="{{ route('products.details', @$product->slug) }}">
                                        <div class="card product-card" style="    border-radius: 11px;">
                                            <img class="card-img-top product-image-style" src="{{ @$product->images()->first()->url }}" alt="">

                                            <div class="card-body text-center">
                                                <h3 class="card-title mt-0">{{ Str::limit(strtoupper(@$product->name), 17) }}</h3>
                                                @if(@$product->price)
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            @include('includes.product-rating.average-rating', @$productRating = @$product)
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if (@$product->discount_price)
                                                                <span>${{ @$product->discount_price }}</span>
                                                                <del>${{ @$product->price }}</del>
                                                            @else
                                                                <span>${{ @$product->price }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @elseif(@$product->productPricesWithSize()->first()->price)
                                                    @php(@$product_size = @$product->productPricesWithSize()->first())
                                                    <div class="row">
                                                        <div class="col-6">
                                                            @include('includes.product-rating.average-rating', @$productRating = @$product)
                                                        </div>
                                                        <div class="col-6">
                                                            @if (@$product_size->discount_price)
                                                                <span>${{ @$product_size->discount_price }}</span>
                                                                <del>${{ @$product_size->price }}</del>
                                                            @else
                                                                <span>${{ @$product_size->price }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning w-100 ml-4">There are no products</div>
                        @endif
                    </div>
                </div>
            </div>

            @if(@$products->count() > 20)
                <div class="row">
                    <div class="row mt-5 text-right justify-content-end">
                        <div class="col-lg-3">
                            {{ @$products->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- cat product end -->
@endsection
