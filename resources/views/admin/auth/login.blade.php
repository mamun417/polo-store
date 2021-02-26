@extends('admin.auth.layouts.app')
@section('title', 'Login')

@section('content')
    <div class="col-sm-8 col-md-offset-4">
        <div class="ibox-content shadow">

            <div style="text-align: center">
                <img alt="image" src="{{ asset('backend/img/logo.png') }}" width="166" />
            </div>

            <h3 class="font-bold">Login</h3>
            <form class="m-t" role="form" method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="admin@test.com" required autocomplete="email" autofocus
                           placeholder="Email">
                    @error('email')
                    <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" value="secret"
                           class="form-control @error('password') is-invalid @enderror" name="password" required
                           autocomplete="current-password" placeholder="Password">
                    @error('password')
                    <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b"><strong>Login</strong></button>

                <a href="{{ route('admin.password.request') }}"><small>Forgot password?</small></a>

{{--                <p class="text-center">--}}
{{--                    <span>Do not have an account?</span>--}}
{{--                </p>--}}
{{--                <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>--}}

            </form>
        </div>
    </div>
@endsection
