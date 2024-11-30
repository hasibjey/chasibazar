<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">

    <title>{{ $title ?? null }} | Chasi Bazar</title>


    <!-- Remix icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Helvetica font -->
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-55" rel="stylesheet">
    <!-- Swiper slide css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('frontend/plugin/select2.min.css') }}">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Style sheet -->
    {{ $css ?? null }}
</head>
<body>
    <section class="wrapper overflow-hidden">

        {{ $slot ?? null }}

        @include('components.frontend.layouts.footer')
    </section>



    <!-- JS section -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/2f7a0c449d.js" crossorigin="anonymous"></script>
    <!-- Swiper slide js -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Scroll -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- Select2 -->
    <script src="{{ asset('frontend/plugin/select2.min.js') }}"></script>
    <!-- counter animation -->
    <script src="{{ asset('frontend/js/counter-animation.js') }}"></script>
    <!-- Slider -->
    <script src="{{ asset('frontend/js/slider.js') }}"></script>
    <!-- Main js -->
    <script src="{{ asset('frontend/js/output.js') }}"></script>

    {{ $js ?? null }}
</body>
</html>
