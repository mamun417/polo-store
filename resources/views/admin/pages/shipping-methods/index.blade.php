@extends('admin.layouts.app')

@section('title', 'Shipping Methods')

@section('content')

    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Shipping Methods</strong>
                </li>
            </ol>
            <a class="btn btn-sm btn-primary pull-right m-t-n-md boardCreateModalShow"
               href="{{ route('admin.shipping-methods.create') }}"><i
                    class="fa fa-plus"></i> <strong>CREATE NEW</strong></a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><strong>All Shipping Methods</strong></h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row" style="margin-bottom: 10px">

                            <div class="col-sm-12">
                                <form action="{{ route('admin.shipping-methods.index')}}" method="get"
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
                                                    <a href="{{ route('admin.shipping-methods.index') }}"
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
                                    <th>#</th>
                                    <th>Ttitle</th>
                                    <th width="8%">Charge</th>
                                    <th width="10%">Applicable Amount</th>
                                    <th width="10%">Modified by</th>
                                    <th width="12%">Last Modified</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(@$shippingMethods->count() > 0)
                                @foreach(@$shippingMethods as $key => $method)
                                    <tr>
                                        <td>{{ @$key+1 }}</td>
                                        <td>{{ @$method->title }}</td>
                                        <td>{{ @$method->charge }}</td>
                                        <td>{{ @$method->applicable_amount }}</td>
                                        <td>{{ @$method->updatedUser->name }}</td>
                                        <td>{{ @$method->updated_at->diffforhumans() }}</td>
                                        <td>
                                            <a onclick="changeStatus(this)" id="{{ @$method->id }}"
                                               data-route="{{ route('admin.shipping-methods.status.change', '') }}"
                                               href="javascript:void(0)"
                                               title="Change publication status">
                                                @if(@$method->status)
                                                    <span class="badge badge-primary">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Disable</span>
                                                @endif
                                            </a>
                                        </td>
                                        <td>
{{--                                            <a href="{{ url('admin/brands/'.@$method->id)  }}" title="View"--}}
{{--                                               class="btn btn-warning btn-sm cus_btn">--}}
{{--                                                <i class="fa fa-eye"></i>--}}
{{--                                            </a>--}}
                                            <a href="{{ url('admin/shipping-methods/'.@$method->id.'/edit')  }}" title="Edit"
                                               class="btn btn-info btn-sm cus_btn">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            <form style="display: none"
                                                  action="{{ url('admin/shipping-methods/'.@$method->id) }}"
                                                  method="post" id="form-delete-{{ @$method->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" title="Delete"
                                                    onclick="if (confirm('Are you sure to delete this item ?'))
                                                        {
                                                        event.preventDefault();
                                                        document.getElementById('form-delete-{{ @$method->id }}').submit();
                                                        }else{
                                                        event.preventDefault()
                                                        }" class="btn btn-danger btn-sm cus_btn">
                                                <i class="fa fa-trash"></i>
                                            </button>
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
                            {{ @$shippingMethods->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>

    </script>
@endpush
