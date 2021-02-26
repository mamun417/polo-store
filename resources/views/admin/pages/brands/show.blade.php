@extends('admin.layouts.app')

@section('title', 'Brand Details')

@section('content')

    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.brands.index') }}">Brand</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Detail</strong>
                </li>
            </ol>
            <a class="btn btn-sm btn-primary pull-right m-t-n-md boardCreateModalShow"
               href="{{ route('admin.brands.index') }}"><i
                    class="fa fa-list"></i> <strong>ALL BRAND</strong></a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>{{ @$brand->name }} Details</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group row">
                            <label for="name" class="col-lg-2 col-form-label">
                                {{ __('Brand Name') }} :
                            </label>
                            <div class="col-lg-10">
                                <p class="lead mb-0">{{ @$brand->name }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="web_url" class="col-lg-2 col-form-label">
                                {{ __('Brand Slug') }} :
                            </label>
                            <label for="web_url" class="col-lg-10 col-form-label">
                                {{@$brand->slug}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="web_url" class="col-lg-2 col-form-label">
                                {{ __('Brand Url') }} :
                            </label>
                            <label for="web_url" class="col-lg-10 col-form-label">
                                {{@$brand->web_url}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="web_url" class="col-lg-2 col-form-label">
                                {{ __('Description') }} :
                            </label>
                            <label for="web_url" class="col-lg-10 col-form-label">
                                {{@$brand->description}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="web_url" class="col-lg-2 col-form-label">
                                {{ __('Status') }} :
                            </label>
                            <label for="web_url" class="col-lg-10 col-form-label">
                                <span class="badge {{ @$brand->status === 0 ? 'badge-danger' : 'badge-primary' }}">
                                    {{ @$brand->status === 0 ? 'Deactive' : 'Active' }}
                                </span>
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="web_url" class="col-lg-2 col-form-label">
                                {{ __('Created By') }} :
                            </label>
                            <label for="web_url" class="col-lg-10 col-form-label">
                                {{ @$brand->createdUser->name }}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="web_url" class="col-lg-2 col-form-label">
                                {{ __('Updated by') }} :
                            </label>
                            <label for="web_url" class="col-lg-10 col-form-label">
                                {{ @$brand->updatedUser->name }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
