@extends('admin.layouts.app')
@section('title', 'Products')

@section('content')
    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Products</strong>
                </li>
            </ol>
            <a class="btn btn-sm btn-primary pull-right m-t-n-md boardCreateModalShow"
               href="{{ route('admin.products.create') }}"><i
                    class="fa fa-plus"></i> <strong>CREATE NEW</strong></a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><strong>Products</strong></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.products.index')}}" method="get"
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
                                                        <option
                                                            value="10"{{ request('perPage') == 10 ? ' selected' : '' }}>
                                                            10
                                                        </option>
                                                        <option
                                                            value="25"{{ request('perPage') == 25 ? ' selected' : '' }}>
                                                            25
                                                        </option>
                                                        <option
                                                            value="50"{{ request('perPage') == 50 ? ' selected' : '' }}>
                                                            50
                                                        </option>
                                                        <option
                                                            value="100"{{ request('perPage') == 100 ? ' selected' : '' }}>
                                                            100
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 pl-sm-1 pr-sm-1 responsive_p_t_f_5">
                                                    <div class="float-left input-group">
                                                        <input name="keyword" type="text"
                                                               value="{{ request('keyword') }}"
                                                               class="input-sm form-control" placeholder="Search Here">
                                                        <span class="input-group-btn">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary custom_field_height"> Go!</button>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 p-0 responsive_p_l_15">
                                                <span>
                                                    <a href="{{ route('admin.products.index') }}"
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

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Tax</th>
                                    <th>Price</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(@$products->count() > 0)
                                    @foreach(@$products as $key => $product)
                                        <tr>
                                            <td>
                                                <img width="100" height="50"
                                                     src="{{ @$product->images()->first()->url ?? '' }}"
                                                     alt="">
                                            </td>
                                            <td>{{ @$product->name }}</td>
                                            <td>{{ @$product->brand->name }}</td>
                                            <td>{{ @$product->category->name }}</td>
                                            <td>
                                                @if(isset($product->tax) && @$product->tax->type == 1)
                                                    {{  @$product->tax->tax }} %
                                                @else
                                                    @if(@$product->price)
                                                        {{ number_format(App\Http\Controllers\Helpers\ProductHelper::taxInPercentage(@$product->price, @$product->tax->tax),2) }}
                                                        %
                                                    @else
                                                        ....
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if(@$product->price)
                                                    {{ getCurrencyIcon('usd') . @$product->price }}
                                                @else
                                                    @foreach(@$product->productPricesWithSize as $productSize)
                                                        <span
                                                            class="badge-success badge">{{ @$productSize->size }} => {{ @$productSize->price }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ @$product->code }}</td>

                                            <td>
                                                <a onclick="changeStatus(this)" id="{{ @$product->id }}"
                                                   data-route="{{ route('admin.products.status.change', '') }}"
                                                   href="javascript:void(0)"
                                                   title="Change publication status">
                                                    @if(@$product->status)
                                                        <span class="badge badge-primary">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Disable</span>
                                                    @endif
                                                </a>
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.products.show', @$product->id) }}"
                                                   class="btn btn-info btn-sm cus_btn">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>

                                                @php($offer_link = route('admin.offers.create')."?product_id=$product->id")
                                                @php($offer = $product->offers->first())
                                                @php($offer_link = $offer ? route('admin.offers.index')."?offer_id=$offer->id" : $offer_link)

                                                <a href="{{ $offer_link }}"
                                                   class="btn btn-success btn-sm cus_btn count-info position-relative">
                                                    <i class="fa fa-gift"></i>
                                                    @if ($offer)
                                                        <span class="label label-warning p-0" style="top: 0; right: 0">
                                                            <i class="fa fa-star"></i>
                                                        </span>
                                                    @endif
                                                </a>

                                                <a href="{{ route('admin.products.edit', @$product->id)  }}"
                                                   title="Edit"
                                                   class="btn btn-info btn-sm cus_btn">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>

                                                <button onclick="deleteRow({{ @$product->id }})"
                                                        href="JavaScript:void(0)"
                                                        title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <form id="row-delete-form{{ @$product->id }}" method="POST"
                                                      class="d-none"
                                                      action="{{ route('admin.products.destroy', @$product->id) }}">
                                                    @method('DELETE')
                                                    @csrf()
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">No recode</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            {{ @$products->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
