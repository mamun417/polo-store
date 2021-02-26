<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('panel/assets/images/favicon.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('panel/assets/images/favicon.png') }}" />
    <title>@yield('title', config('app.name')) | {{ config('app.name', 'Polo Store') }}</title>
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/custom-style.css') }}" rel="stylesheet">

    @stack('style')

</head>
<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>
</body>

<script src="{{ asset('backend/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>

<!-- iCheck -->
<script src="{{ asset('backend/js/plugins/iCheck/icheck.min.js') }}"></script>

@yield('custom-js')

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    $(function () {
        @foreach(['success', 'warning', 'error', 'info'] as $item)
            @if(session($item))
                toastr['{{ $item }}']('{{ session($item) }}');
            @endif
        @endforeach
    });
</script>

</html>
