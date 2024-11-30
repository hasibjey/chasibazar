<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        @endif
    </head>
    <body>
        <section class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            {{ $slot }}
        </section>

        <form action="{{ route('logout') }}" method="post" id="logout">
            @csrf
        </form>

        <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
        {{ $js ?? null}}
    </body>
</html>
