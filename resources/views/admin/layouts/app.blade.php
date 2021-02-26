<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', config('app.name')) | {{ config('app.name', 'Polo Store Dashboard') }}</title>

    {{-- all-css --}}
    @include('admin.includes.all-css')


</head>

<body class="fixed-sidebar">

<div id="wrapper">

    {{-- sidebar --}}
    @include('admin.includes.sidebar')

    <div id="page-wrapper" class="gray-bg">

        <div class="row border-bottom">
            @include('admin.includes.header')
        </div>

        <div class="wrapper wrapper-content">
            @yield('content')
        </div>

        @include('admin.includes.footer')

    </div>

    @include('admin.includes.right-sidebar')
</div>

{{--    all-js    --}}
@include('admin.includes.all-js')



</body>
</html>
