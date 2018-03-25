<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('partials.meta')
    @include('partials.favicon')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    @stack('styles')
    <link rel="stylesheet" href="{{ mix('frontend/app-v3.css') }}" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    {{-- <div class="page_bg"></div> --}}
    @include('partials.header')

    <div class="container">
        @include('partials.breadcrumbs')
        @include('partials.title')
        @yield('content')
    </div>

    @include('partials.footer')

    <!--[if lt IE 9]>
    <script src="{{ asset('frontend/plugins/jquery/jquery-1.12.4.min.js') }}"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="{{ asset('frontend/plugins/jquery/jquery-2.2.4.min.js') }}" defer></script>
    <!--<![endif]-->
    <script src="{{ mix('frontend/app-v3.js') }}" defer></script>
    @stack('scripts')

    @if ($_ENV['APP_ENV'] == 'production')
        @include('partials.counters')
    @endif
</body>
</html>