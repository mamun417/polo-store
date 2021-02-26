@extends('admin.layouts.app')

@section('title', 'Customers')

@section('content')

    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Customers</strong>
                </li>
            </ol>
{{--            <a class="btn btn-sm btn-primary pull-right m-t-n-md boardCreateModalShow"--}}
{{--               href="{{ route('admin.customers.create') }}">--}}
{{--                <i class="fa fa-plus"></i> <strong>Create New</strong>--}}
{{--            </a>--}}
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><strong>Customer List</strong></h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row" style="margin-bottom: 10px">

                            <div class="col-sm-12">
                                <form action="{{ route('admin.customers.index')}}" method="get"
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
                                                    <a href="{{ route('admin.customers.index') }}"
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
                            <table class="table table-hover table-bordered customer-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="25%">Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(@$customers as $key => $customer)
                                    <tr>
                                        <td>{{ @$key+1 }}</td>
                                        <td>
                                            <div class="social-avatar text-left">
                                                <div class="float-left">
                                                    <img class="rounded-circle"
                                                         alt="User"
                                                         src="{{ asset('backend/img/profile/man.svg') }}">
                                                </div>
                                                <div class="media-body">
                                                    <span class="pl-2">{{ @$customer->name }}</span>
                                                </div>
                                            </div>
                                        <td>{{ @$customer->email }}</td>
                                        <td>{{ @$customer->created_at->diffforhumans() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ @$customers->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

@endpush
