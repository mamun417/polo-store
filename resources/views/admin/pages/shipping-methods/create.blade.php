@extends('admin.layouts.app')

@section('title', 'Shipping Method Create')

@section('content')

    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Shipping Method Create</strong>
                </li>
            </ol>
            <a class="btn btn-sm btn-primary pull-right m-t-n-md boardCreateModalShow"
               href="{{ route('admin.shipping-methods.index') }}">
                <i class="fa fa-list"></i>
                <strong>All Shipping Method</strong>
            </a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="upload-form row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Add new shipping method</h5>
                    </div>
                    <div class="ibox-content" style="">
                        <form action="{{ route('admin.shipping-methods.store') }}" method="post">
                            @csrf
                            <div class="row">
                                @include('admin.pages.shipping-methods.elements')
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary" type="submit">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')

@endpush
