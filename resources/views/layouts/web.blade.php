<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Changia</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://checkout.beem.africa/dist/0.1_alpha/bpay.min.css'/>
</head>
    <body class="antialiased">
        <x-app-bar></x-app-bar>
            <div style="min-height: 400px;">
                @yield('content')
            </div>
        <x-footer></x-footer>
    </body>
    <script src="{{ asset('js/app.js') }}" ></script>
    <script>
        $(".datepicker").datepicker();
    </script>

    @yield('script')
</html>

