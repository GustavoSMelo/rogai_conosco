<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:title" content="{{ $title ?? 'Rogai Conosco' }}">
    <meta property="og:description" content="{{ $meta['description'] ?? 'Rogai Conosco' }}">
    <meta property="og:image" content="{{ $meta['image'] ?? asset('images/ovelhinha.png') }}">
    <meta property="og:type" content="website">

    <title>{{ $title ?? 'Rogai Conosco' }}</title>

    @vite(['resources/css/app.css', 'resources/css/result.css'])

    @livewireStyles
</head>
<body class="result-page-body min-h-screen flex items-center justify-center px-6 py-16">
    {{ $slot }}

    @livewireScripts
</body>
</html>
