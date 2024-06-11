<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIDAQ TPQ | {{ $title ?? 'home' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <!-- Splide J -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @livewireStyles --}}
</head>

<body class="font-montserrat text-gray-900 antialiased min-h-screen flex flex-col justify-between">
    @if (!request()->routeIs('login') && !request()->routeIs('register') && !request()->routeIs('profile.create'))
        @include('components.partials.home.navbar')
    @endif

    <main>
        <div class="flex gap-x-10 glass rounded-md shadow-md">

            {{-- @include('components.partials.home.sidebar') --}}

            <div class="w-full">
                {{ $slot }}
            </div>
        </div>

    </main>

    {{-- @include('components.partials.home.footer') --}}
    @livewireScripts
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('.splide', {
            type: 'fade',
            autoplay: true,
            interval: 3000, // Interval dalam milidetik
        }).mount();
    });
</script>

</html>
