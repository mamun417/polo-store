@extends('admin.layouts.app')

@section('title', 'Offers')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Offers</strong>
                </li>
            </ol>
{{--            <a class="btn btn-sm btn-primary pull-right m-t-n-md"--}}
{{--               href="{{ route('admin.offers.create') }}"><i--}}
{{--                    class="fa fa-plus"></i> <strong>CREATE NEW</strong></a>--}}
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>All Offers</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ route('admin.offers.index')}}" method="get"
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
                                            </div>
                                            <div class="col-md-6 pl-sm-1 pr-sm-1 responsive_p_t_f_5">
                                                <div class="float-left input-group">
                                                    <input name="keyword" type="text" value="{{ request('keyword') }}"
                                                           class="input-sm form-control" placeholder="Search Here">
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-sm btn-primary custom_field_height"> Go!</button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-1 p-0 responsive_p_l_15">
                                                <span>
                                                    <a href="{{ route('admin.offers.index') }}"
                                                        class="btn btn-default btn-sm custom_field_height">Reset
                                                    </a>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </form>

                        <div class="table-responsive m-t-md">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-left">Product Name</th>
                                    <th class="text-left">Offer Title</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Start At</th>
                                    <th>Expire At</th>
                                    <th>Create At</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($offers as $offer)
                                    <tr>
                                        <td class="text-left">{{ ucfirst(Str::limit($offer->product->name, 50)) }}</td>
                                        <td class="text-left">{{ ucfirst(Str::limit(@$offer->title, 50)) }}</td>
                                        <td>{{ $offer->amount }}</td>
                                        <td class="text-left">{{ ucfirst(\App\Models\Offer::OFFER_TYPE[@$offer->type]) }}</td>
                                        <td>
                                            {{ $offer->start_at->diffforhumans() }}
                                            @if (\Carbon\Carbon::instance($offer->start_at)->isBefore(now()))
                                                <span class="badge badge-info">started</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $offer->expire_at->diffforhumans() }}
                                            @if (\Carbon\Carbon::instance($offer->expire_at)->isBefore(now()))
                                                <span class="badge badge-warning">expired</span>
                                            @endif
                                        </td>
                                        <td>{{ $offer->created_at->diffforhumans() }}</td>
                                        <td>
                                            <a onclick="changeStatus(this)" id="{{ $offer->id }}"
                                               data-route="{{ route('admin.offers.status.change', '') }}"
                                               href="javascript:void(0)"
                                               title="Change publication status">
                                                @if($offer->status)
                                                    <span class="badge badge-primary">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Disable</span>
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.offers.edit', @$offer->id)  }}"
                                               title="Edit"
                                               class="btn btn-info btn-sm cus_btn">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>

                                            <button onclick="deleteRow({{ $offer->id }})" href="JavaScript:void(0)"
                                                    title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <form id="row-delete-form{{ $offer->id }}" method="POST" class="d-none"
                                                  action="{{ route('admin.offers.destroy', $offer->id) }}">
                                                @method('DELETE')
                                                @csrf()
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if (count($offers))
                                {{ $offers->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}
                            @else
                                <div class="text-center">No offer found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


