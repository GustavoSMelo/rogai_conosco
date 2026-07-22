<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $meta['description'] ?? 'Rogai Conosco — Um lugar seguro para pedir oração anonimamente.' }}">

    <meta property="og:title" content="{{ $meta['title'] ?? 'Rogai Conosco' }}">
    <meta property="og:description" content="{{ $meta['description'] ?? 'Rogai Conosco — Um lugar seguro para pedir oração anonimamente.' }}">
    <meta property="og:image" content="{{ $meta['image'] ?? asset('images/ovelhinha.png') }}">
    <meta property="og:type" content="website">

    <title>{{ $meta['title'] ?? 'Rogai Conosco' }}</title>

    @vite(['resources/css/app.css', 'resources/css/result.css'])
</head>
<body class="result-page-body min-h-screen flex items-center justify-center px-6 py-16">
    @yield('content')
</body>
</html>
