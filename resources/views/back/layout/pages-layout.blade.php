<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('titlePage')</title>
    <!-- CSS files -->
    <base href="/">
    <link href="./back/dist/css/tabler.min.css?1684106062" rel="stylesheet" />
    <link href="./back/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet" />
    <link href="./back/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet" />
    <link href="./back/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet" />
    <link href="./back/dist/css/demo.min.css?1684106062" rel="stylesheet" />
    @stack('stylsheets')
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    <script src="./back/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
        <!-- Navbar -->
        @include('back.layout.inc.header')
        <div class="page-wrapper">
            <!-- Page header -->
            @yield('header')
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
            @include('back.layout.inc.footer')
        </div>
    </div>
    
    <!-- Libs JS -->
    <script src="./back/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/maps/world.js?1684106062" defer></script>
    @stack('scripts')
    <script src="./back/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062" defer></script>
    <!-- Tabler Core -->
    <script src="./back/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./back/dist/js/demo.min.js?1684106062" defer></script>

</body>

</html>