<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/22f6c26f69.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue", 'resources/scss/main.scss'])
        @inertiaHead
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        @inertia

        @include('partials.footer')
    </body>
</html>
