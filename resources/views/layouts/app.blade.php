<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Library' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="public\build\assets\app.css">
</head>
<body class="pt-16">
    @include('layouts.navbar')

    <main class="container mx-auto px-6 py-10">
        @yield('content')
    </main>

    @include('layouts.footer')
</body>
</html>