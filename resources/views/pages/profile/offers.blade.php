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
                                <form action="{{ route('user.offers.index') }}">
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="order-block p-3 shadow mt-4">
                            @if($offers->count() > 0)
                                <div class="table-responsive">
                                    <table id="cart-table"
                                           class="table table-striped text-center" style="overflow-x: visible;">
                                        <thead>
                                        <tr>
                                            <th class="w-10">Image</th>
                                            <th class="w-35">Product Name</th>
                                            <th class="w-35">Offer</th>
                                            <th class="w-10">Available For</th>
                                            <th class="w-10">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody class="cart-detail">
                                        @foreach(@$offers as $offer)
                                            <tr class="cart-items">
                                                <td class="item-thumbnail">
                                                    <img class="img-fluid cart-detail-img"
                                                         src="{{ @$offer->product->images()->first()->url }}"
                                                         alt="{{ Str::limit(@$offer->product->name , 10)}}">
                                                </td>
                                                <td class="item-title">
                                                    <p class="m-0"> {{ Str::limit(@$offer->product->name , 15) }}</p>
                                                </td>
                                                <td class="item-title">
                                                    @if(@$offer->type == 1)
                                                        {{ @$offer->amount }} %
                                                    @else
                                                        ${{ @$offer->amount }}
                                                    @endif
                                                </td>
                                                <td class="item-title">
                                                    {{ $offer->expire_at->diffforhumans() }}
                                                </td>

                                                <td class="item-aciton p-0">
                                                <span class="action">
                                                    <form method="post"
                                                          action="{{ route('user.offers.delete', $offer->id) }}"
                                                          id="deleteOfferForm-{{ $offer->id }}">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <a href="javascript:void(0)"
                                                       onclick="event.preventDefault(); if (confirm('Are you sure to delete your offer')){
                                                           document.getElementById('deleteOfferForm-'+'{{ $offer->id }}').submit()
                                                           }" type="button"
                                                       class="btn btn-sm btn-danger">
                                                      CANCEL NOW
                                                    </a>
                                                    @if($offer->expire_at < now())
                                                        <button class="btn btn-sm btn-warning">Expired</button>
                                                    @else
                                                        <a href="{{ route('products.details', @$offer->product->slug) .'?offerId='.@$offer->id }}"
                                                           class="btn btn-sm btn-info">
                                                       APPLY NOW
                                                    </a>
                                                    @endif

                                                </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ @$offers->appends(['perPage' => request('perPage')])->links() }}
                            @else
                                <div class="col-lg-12 mb-5 mt-5">
                                    <div class="alert alert-danger">
                                        <strong>There are no offers</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
