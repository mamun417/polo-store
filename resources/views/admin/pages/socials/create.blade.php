@extends('admin.layouts.app')
@section('title', 'Social')

@section('content')
    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.socials.index') }}">Social</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Create</strong>
                </li>
            </ol>
            <a class="btn btn-sm btn-primary pull-right m-t-n-md boardCreateModalShow"
               href="{{ route('admin.socials.index') }}"><i
                    class="fa fa-list"></i> <strong>ALL SOCIAL</strong></a>
        </div>
    </div>
    <div class="wrapper wrapper-content animated">
        <form action="{{ route('admin.socials.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Create a new social for your company</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                @include('admin.pages.socials.element')
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.socials.index') }}" class="btn btn-danger" type="submit">Chancel</a>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
