@extends('admin.auth.layouts.app')
@section('title', 'Reset Password')

@section('content')
    <div class="col-sm-8 col-md-offset-4">
        <div class="ibox-content">
            <div style="text-align: center">
                <img alt="image" src="{{ asset('backend/img/logo.png') }}" width="166"/>
            </div>

            @if (session('status'))
                <div class="alert alert-success mt-2" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h3 class="font-bold">Reset Password</h3>

            <form class="m-t" role="form" method="POST" action="{{ route('admin.password.email') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           placeholder="Email">
                    @error('email')
                    <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary block full-width"><strong>Reset Password</strong></button>
            </form>
        </div>
    </div>
@endsection
