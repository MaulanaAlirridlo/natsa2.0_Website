<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">

    <title>@yield('title')</title>

    {{-- tailwind css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    {{-- fontawesome css --}}
    <link rel="stylesheet" href="{{ mix('css/style.css') }}" />

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>

<body>
    <div x-data="{ cartOpen: false , isOpen: false }">
        @include('user.partials.navbar')


        <main class="my-8">
            @yield('body')
        </main>

        @include('user.partials.footer')
    </div>
</body>

</html>