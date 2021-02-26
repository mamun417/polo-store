@extends('admin.layouts.app')
@section('title', 'Products')

@push('style')
    <link href="{{ asset('backend/css/plugins/colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/plugins/select2/select2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.products.index') }}">Product</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Create</strong>
                </li>
            </ol>
            <a class="btn btn-sm btn-primary pull-right m-t-n-md boardCreateModalShow"
               href="{{ route('admin.products.index') }}"><i
                    class="fa fa-list"></i> <strong>ALL PRODUCT</strong></a>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.products.elements')

            <a href="{{ route('admin.products.index') }}" class="btn btn-danger" type="submit">Cancel</a>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
@endsection

@push('script')
    @include('admin.pages.products.admin-product-script')
@endpush

