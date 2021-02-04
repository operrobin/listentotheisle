<html>

<head>
    <title>HOME - ISLE MUSIC</title>
    @yield('seo')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('frontend.layouts.style')
    @yield('style')
</head>

<body>
    <div id="isle">
    @include('frontend.layouts.header')

        @yield('content')

    @include('frontend.layouts.footer')

    </div>
</body>

@include('frontend.layouts.script')

</html>
