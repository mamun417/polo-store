@extends('layouts.app')
@section('title', 'Product Details')

@push('style')
    <style>
        .colorRadioBtn {
            font-size: 30px;
            width: 20px;
            height: 20px;
        }
    </style>
@endpush

@section('content')
    <!-- single product start -->
    <section class="cat-product section-padding">
        <div class="container">
            <!--            <div class="row">
                            <div class="col-lg-12">
                                &lt;!&ndash;  Dropdown Area Start &ndash;&gt;
                                <div class="classy-nav-container small-dropdown breakpoint-off float-right">
                                    <div class="classynav ">
                                        <ul>
                                            <li><a href="#">Feature</a>
                                                <ul class="dropdown">
                                                    <li><a href="index.html">Home</a></li>
                                                    <li><a href="about-us.html">About</a></li>
                                                    <li><a href="services.html">Services</a></li>
                                                    <li><a href="rooms.html">Rooms</a></li>
                                                    <li><a href="blog.html">News</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                &lt;!&ndash; Dropdown Area End &ndash;&gt;
                            </div>
                        </div>-->
            <div class="row">
                <div class="col-lg-2">
                    @include('includes.sidebar.sidebar')
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <div class="flexslider">
                                <ul class="slides">
                                    @foreach(@$product->images as  $image)
                                        <li data-thumb="{{  @$image->url }}">
                                            <div class="thumb-image">
                                                <img src="{{ @$image->url }}" data-imagezoom="true"
                                                     class="img-responsive" alt=""/>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @include("includes.product-rating.modal")
                        <div class="col-lg-5 col-md-6">
                            <div class="single-prodcut-content mt-0">
                                <form action="{{ route('cart.store', @$product->slug) }}" method="post">
                                    @csrf

                                    <input type="hidden" name="offer_id"
                                           value="{{@$cart_product ? @$cart_product->options['offer_id'] : request('offerId') }}">

                                    <input type="hidden" name="exist_cart" value="{{ @$cart_product ? true : false }}">
                                    <input type="hidden" name="rowId"
                                           value="{{ @$cart_product ? @$cart_product->rowId : '' }}">
                                    <span>{{ @$product->code }}</span>
                                    <h4 class="product-name">{{ @$product->name }}</h4>

                                    {{--Start Rating--}}
                                    <div class="rating" data-toggle="modal" data-target="#ratingModal">
                                        @if($product_rating_count = @$product->ratings->count() > 0)
                                            <label class="star_default_color rating_count ml-1">( {{ @$product_rating_count }} )</label>
                                        @endif
                                        @for ($i = 4; $i >= 0; $i--)
                                            @if (@$product_rating - $i >= 1)
                                                {{--Full Rating Start--}}
                                                <label class="star_size text-warning"><i class="fa fa-star"></i></label>
                                            @elseif (@$product_rating - $i > 0)
                                                {{--Half Rating Start--}}
                                                <label class="text-warning star_size"><i class="fa fa-star-half"></i></label>
                                            @else
                                                {{--Empty Rating Start--}}
                                                <label class="star_default_color star_size"><i class="fa fa-star"></i></label>
                                            @endif
                                        @endfor
                                    </div>
                                    <!--End Rating-->

                                    <!--  Start ==> Product Price sections-->
                                    <div class="cat-product-items_price">
                                        @if(@$product->price)
                                            @if (@$product->discount_price)
                                                <span>${{ @$product->discount_price }}</span>
                                                <del>${{ @$product->price }}</del>
                                            @else
                                                <span>${{ @$product->price }}</span>
                                            @endif
                                        @elseif(@$product->productPricesWithSize()->first()->price)
                                            @php
                                                @$productSizePrice = @$product->productPricesWithSize()->first()
                                            @endphp
                                            @if (@$productSizePrice->discount_price)
                                                <span
                                                    id="productDiscountPriceONDetailsPage">${{ @$productSizePrice->discount_price }}</span>
                                                <del id="productPriceONDetailsPage">
                                                    ${{ @$productSizePrice->price }}</del>
                                            @else
                                                <span
                                                    id="productDiscountPriceONDetailsPage">${{ @$productSizePrice->price }}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <!--  End ==> Product Price sections-->

                                    <!--  Start ==> Product  discount Price sections-->
                                    @if(@$product->price)
                                        @if (@$product->discount_price)
                                            <p class="m-0">
                                                You
                                                save {{ discountRate(@$product->price, @$product->discount_price) }}
                                                % (${{ @$product->price - @$product->discount_price }})
                                            </p>
                                        @endif
                                    @elseif(@$product->productPricesWithSize()->first()->price)
                                        @php
                                            $product_size = @$product->productPricesWithSize()->first()
                                        @endphp
                                        @if (@$product_size->discount_price)
                                            <p class="m-0" id="productDiscountDetailsPage">
                                                You
                                                save {{ discountRate(@$product_size->price, @$product_size->discount_price) }}
                                                % (${{ @$product_size->price - @$product_size->discount_price }})
                                            </p>
                                        @endif
                                    @endif
                                <!--  End ==> Product  discount Price sections-->

                                    <!--  Start ==> Product color sections-->
                                    @if (isset($product->color) && count(json_decode(@$product->color)))
                                        <div class="cat-product-items_color">
                                            <p class="m-0 font-weight-bold mb-1">Color</p>
                                            <div class="text-center d-flex">
                                                @foreach(json_decode(@$product->color) as $color)
                                                    <div class="form-check">
                                                        <input type="radio" value="{{ @$color }}" name="color"
                                                               class="form-check-input" id="exampleColor{{ @$color }}"
                                                               required {{ @$cart_product->options['color'] === @$color ? 'checked' : '' }}>

                                                        <label class="form-check-label mr-3"
                                                               for="exampleColor{{ @$color }}">
                                                            {{ ucfirst(@$color)  }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                @error('color')
                                                <div class="text-danger">{{ @$message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                <!--  End ==> Product color sections-->

                                    <!--  Start ==> Product  size with  Price sections-->
                                    @if (count(@$product->productPricesWithSize) && !@$product->price)
                                        <div class="cat-product-items_color mt-2">
                                            <p class="m-0 font-weight-bold mb-1">Size</p>
                                            <div class="text-center d-flex">
                                                @foreach(@$product->productPricesWithSize as $size)
                                                    @php
                                                        $size = @$size->size
                                                    @endphp
                                                    <div class="form-check">

                                                    @if(@$cart_product->options['size']) <!-- // if get cart size then set checked by this-->
                                                        <input type="radio" value="{{ @$size }}" name="size"
                                                               data-product="{{ @$product->id }}"
                                                               class="form-check-input productSizeCheck"
                                                               id="exampleSize{{ @$size }}"
                                                               required {{  @$cart_product->options['size'] === @$size ? 'checked' : '' }}>
                                                        @else
                                                            <input type="radio" value="{{ @$size }}" name="size"
                                                                   data-product="{{ @$product->id }}"
                                                                   class="form-check-input productSizeCheck"
                                                                   id="exampleSize{{ @$size }}"
                                                                   required {{  @$product_size->size === @$size ? 'checked' : '' }}>
                                                        @endif

                                                        <label class="form-check-label mr-3"
                                                               for="exampleSize{{ @$size }}">
                                                            {{ ucfirst(@$size)  }}
                                                        </label>
                                                    </div>
                                                @endforeach

                                                @error('size')
                                                <div class="text-danger">{{ @$message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                @endif
                                <!--  End ==> Product  size with  Price sections-->

                                    <div class="quantity-area">
                                        <p class="mt-2 mb-1 font-weight-bold ">QUANTITY</p>
                                        <input class="form-control qty" type="hidden" name="qty"
                                               value="{{ @$cart_product->qty ?? 1 }}" min="1">
                                        <table class="mt-2">
                                            <tr>
                                                <td class="qty-minus">
                                                    <i class="fa fa-minus btn btn-sm" aria-hidden="true"
                                                       onclick="updateQty('down')">
                                                    </i>
                                                </td>
                                                <td class="qty-text">{{ @$cart_product->qty ?? 1 }}</td>
                                                <td>
                                                    <i class="fa fa-plus btn btn-sm" aria-hidden="true"
                                                       onclick="updateQty('up')">
                                                    </i>
                                                </td>
                                            </tr>
                                        </table>

                                        @error('qty')
                                        <div class="text-danger">{{ @$message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-center flex-nowrap">
                                        <div class="col-lg-6 col-md-6  col-sm-6 pr-0">
                                            <button type="submit" class="btn btn-secondary login-btn">
                                                {{ @$cart_product ? 'Update Cart' : 'Add to Cart' }}
                                            </button>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 pl-0">
                                            <!--<a href="#"> <img src="assets/images/amazon2.png" alt=""></a>
                                                <a href="">
                                                    <p class="payment-text">More Payment Options</p>
                                                </a>-->
                                        </div>
                                    </div>
                                </form>
                                <div class="product-desc-area">
                                    <p class="font-weight-bold">Overview</p>
                                    {!! @$product->details !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  Comment block  --}}
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h3>Comments</h3>
                            <hr/>
                            <!-- comment table -->
                            <table class="comment-table pl-2" id="">

                                @foreach($product->comments()->where('parent_id', 0)->get() as $comment)
                                    <tr>
                                        <td width="64" class="py-3 px-3">
                                            <img
                                                width="64"
                                                src="{{ isset($comment->user->image) ? $comment->user->image->url : asset('frontend/assets/images/user.svg') }}"
                                                class="rounded-circle float-left"
                                                alt="user_name"
                                            />
                                        </td>

                                        <td class="py-3 pr-3">
                                            <div class="comment-body">
                                                <h6 class="m-0">{{ $comment->user ? $comment->user->name : 'unknown' }}</h6>
                                                <p>{{ $comment->body }}</p>
                                            </div>
                                            <div class="like-reply">
                                                <ul class="pl-0">
                                                    <li>
                                                        @php
                                                            $belongToAuth = $comment->likes()->where('user_id', auth()->id())->first();
                                                            $bold = $belongToAuth ? '800' : 'normal'
                                                        @endphp
                                                        <small>
                                                            <a href="javascript:void(0)"
                                                               style="font-weight: {{ $bold }}"
                                                               class="likeCommentAndReplay"
                                                               data-comment_replay_id="{{ $comment->id }}">
                                                                Like
                                                                <span>{{ $comment->likes()->count() > 0 ? $comment->likes()->count() :  0 }}</span>
                                                            </a>
                                                        </small>
                                                    </li>
                                                    <li>·</li>
                                                    <li>
                                                        <small><a href="javascript:void(0)"
                                                                  data-commentid="{{ $comment->id }}"
                                                                  class="showParentReplyForm">Reply</a></small>
                                                    </li>
                                                    <li>·</li>
                                                    <li>
                                                        <small>{{ $comment->created_at->diffforhumans() }}</small>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Start => comment reply replay section -->
                                            @if (count($comment->replies))
                                                <table class="reply-table pl-2" id="">
                                                    @foreach($comment->replies as $reply)
                                                        <tr>
                                                            <td width="48" class="pr-3">
                                                                <img
                                                                    width="48s"
                                                                    src="{{ isset($reply->user->image) ? $reply->user->image->url : asset('frontend/assets/images/user.svg') }}"
                                                                    class="rounded-circle float-left"
                                                                    alt="user_name"
                                                                />
                                                            </td>
                                                            <td class="">
                                                                <div class="comment-body">
                                                                    <h6 class="m-0">{{ $reply->user ? $reply->user->name : 'unknown' }}</h6>
                                                                    <p>{{ $reply->body }}</p>
                                                                </div>
                                                                <div class="like-reply">
                                                                    <ul class="pl-0">
                                                                        <li>
                                                                            @php
                                                                                $belongToAuth = $reply->likes()->where('user_id', auth()->id())->first();
                                                                                $bold = $belongToAuth ? '800' : 'normal'
                                                                            @endphp
                                                                            <small>
                                                                                <a href="javascript:void(0)"
                                                                                   style="font-weight: {{ $bold }}"
                                                                                   class="likeCommentAndReplay"
                                                                                   data-comment_replay_id="{{ $reply->id }}">
                                                                                    Like
                                                                                    <span>{{ $reply->likes()->count() > 0 ? $reply->likes()->count() :  0 }}</span>
                                                                                </a>
                                                                            </small>
                                                                        </li>
                                                                        <li>·</li>
                                                                        <li>
                                                                            <small><a class="showReplayForm"
                                                                                      href="javascript:void(0)"
                                                                                      data-replyid="{{ $reply->id }}">Reply</a></small>
                                                                        </li>
                                                                        <li>·</li>
                                                                        <li>
                                                                            <small>{{ $reply->created_at->diffforhumans() }}</small>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="hideAllCommentReplayForm"
                                                            id="commentReplaySection-{{ $reply->id }}">
                                                            <td width="64" class="py-3 px-3">
                                                                <img
                                                                    width="64"
                                                                    src="{{ asset('frontend/assets/images/user.svg') }}"
                                                                    class="rounded-circle float-left"
                                                                    alt="user_name"
                                                                />
                                                            </td>
                                                            <td class="py-3 pr-3"
                                                                style="vertical-align: middle">
                                                                <form
                                                                    action="{{ route('product.comments.store', $product->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="parent_id"
                                                                           value="{{ $comment->id }}">
                                                                    <div class="form-group mt-2">
                                                                        <input
                                                                            type="text"
                                                                            name="body"
                                                                            class="form-control rounded-pill comment-inp"
                                                                            placeholder="Write a comment..."
                                                                        />
                                                                        @error('body')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                        @endif
                                        <!-- End => comment reply replay section -->

                                            <!-- Start => comment replay section-->
                                            <table class="reply-table pl-2" id="">
                                                <tr class="hideAllCommentReplayForm"
                                                    id="parentCommentReplaySection-{{ $comment->id }}">
                                                    <td width="64" class="py-3 px-3">
                                                        <img
                                                            width="64"
                                                            src="{{ isset(Auth::user()->image) ? Auth::user()->image->url : asset('frontend/assets/images/user.svg') }}"
                                                            class="rounded-circle float-left"
                                                            alt="user_name"
                                                        />
                                                    </td>
                                                    <td class="py-3 pr-3" style="vertical-align: middle">
                                                        <form
                                                            action="{{ route('product.comments.store', $product->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="parent_id"
                                                                   value="{{ $comment->id }}">
                                                            <div class="form-group mt-2">
                                                                <input
                                                                    type="text"
                                                                    name="body"
                                                                    class="form-control rounded-pill comment-inp"
                                                                    placeholder="Write a comment..."
                                                                />
                                                                @error('body')
                                                                <small
                                                                    class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- End => comment replay section-->
                                        </td>
                                    </tr>
                            @endforeach

                            <!-- Start comment submit section-->
                                <tr>
                                    <td width="64" class="py-3 px-3">
                                        <img
                                            width="64"
                                            src="{{ isset(Auth::user()->image) ? Auth::user()->image->url : asset('frontend/assets/images/user.svg') }}"
                                            class="rounded-circle float-left"
                                            alt="user_name"
                                        />
                                    </td>
                                    <td class="py-3 pr-3" style="vertical-align: middle">
                                        <form action="{{ route('product.comments.store', $product->id) }}"
                                              method="post">
                                            @csrf
                                            <input type="hidden" name="parent_id" value="0">
                                            <div class="form-group mt-2">
                                                <input
                                                    type="text"
                                                    name="body"
                                                    class="form-control rounded-pill comment-inp"
                                                    placeholder="Write a comment..."
                                                />
                                                @error('body')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <!-- End comment submit section-->
                            </table>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cat product start -->
            @if(@$related_product->count())
                <div class=" mt-3 mb-3">
                    <h3 class="section-title"> YOU MAY ALSO LIKE</h3>
                </div>
                <div class="row">
                    @foreach(@$related_product as $related_product)
                        <div class="col-lg-4 col-md-6 col-sm-12 pr-0 mb-3">
                            <a href="{{ route('products.details', @$related_product->slug) }}">
                                <div class="card product-card" style="    border-radius: 11px;">
                                    <img class="card-img-top product-image-style"
                                         src="{{ @$related_product->images()->first()->url }}" alt="">
                                    <hr class="mt-0">
                                    <div class="card-body text-center">
                                        <h3 class="card-title mt-0">{{ Str::limit(strtoupper(@$related_product->name), 17) }}</h3>
                                        @if(@$related_product->price)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @include("includes.product-rating.average-rating", $productRating = $related_product)
                                                </div>
                                                <div class="col-md-6">
                                                    @if (@$related_product->discount_price)
                                                        <span>${{ @$related_product->discount_price }}</span>
                                                        <del>${{ @$related_product->price }}</del>
                                                    @else
                                                        <span>${{ @$related_product->price }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif(@$related_product->productPricesWithSize()->first()->price)
                                            @php
                                                $related_product_with_price = @$product->productPricesWithSize()->first();
                                            @endphp
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @include("includes.product-rating.average-rating", $productRating = @$related_product)
                                                </div>
                                                <div class="col-md-6">
                                                    @if (@$related_product_with_price->discount_price)
                                                        <span>${{ @$related_product_with_price->discount_price }}</span>
                                                        <del>${{ @$related_product_with_price->price }}</del>
                                                    @else
                                                        <span>${{ @$related_product_with_price->price }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- Single product end -->
@endsection

@push('script')
    <script>
        function updateQty(type) {
            let qty = $('.qty').val()

            if (type === 'down') {
                if (qty === '1') return
                qty--
            } else {
                qty++
            }

            $('.qty').val(qty);

            $('.qty-text').text(qty);
        }

        $().ready(function () {
            $(".productSizeCheck").each(function () {
                $(this).on('change', function () {
                    let product_id = $(this).data('product')
                    let size = $(this).val()
                    axios.post('{{ route('product.get.size-wise-price') }}', {product_id, size,})
                        .then((res) => {
                            res = res.data
                            let percentage = ((res.price - res.discount_price) / res.price * 100)
                            let discount = res.price - res.discount_price

                            if (res.discount_price) {
                                $("#productDiscountPriceONDetailsPage").text(`$` + res.discount_price)
                                $("#productPriceONDetailsPage").text(`$` + res.price)
                                $("#productDiscountDetailsPage").html(`You save ${percentage.toFixed(2)}
                                                                % ($ ${discount})`)
                            } else {
                                $("#productDiscountPriceONDetailsPage").text(`$` + res.price)
                                $("#productPriceONDetailsPage").text('')
                                $("#productDiscountDetailsPage").html(``)
                            }
                        })
                })
            })
        })

        let auth = "{{ auth()->check() }}"
        let requestParams = "{{ request('offerId') }}"
        if (requestParams && !auth) {
            $("#loginModal").modal('show')
        }


        // Start => product comment section
        $().ready(function () {
            $(".hideAllCommentReplayForm").hide()

            $(".showReplayForm").each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault()
                    let replyId = $(this).data('replyid')
                    $(`#commentReplaySection-${replyId}`).show()
                })
            })

            $(".showParentReplyForm").each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault()
                    let commentId = $(this).data('commentid')
                    $(`#parentCommentReplaySection-${commentId}`).show()
                })
            })

            $(".likeCommentAndReplay").each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault()
                    let comment_replay_id = $(this).data('comment_replay_id')
                    let getLike = $(this).children('span')
                    let totalLike = parseInt(getLike.text())

                    if ("{{ !Auth::check() }}") {
                        toastr.error('You need to login first !')
                        return false
                    }


                    $.get('{{ route('product.comments.like-unlike') }}', {comment_replay_id: comment_replay_id}, (res) => {
                        if (res == 'add') {
                            getLike.text(totalLike + 1)
                            $(this).css('fontWeight', '800')
                        } else if (res == 'remove') {
                            getLike.text(totalLike - 1)
                            $(this).css('fontWeight', 'normal')
                        } else {
                            toastr.error('something is wrong')
                        }
                    })
                })
            })
        })

        // End => product comment section


    </script>
@endpush
