<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', data_get($siteSettings ?? [], 'app_name', config('app.name')))</title>
        <meta name="description" content="@yield('meta_description', data_get($siteSettings ?? [], 'hero_subtitle', 'Portal resmi Indonesia IMT-GT Business Centre.'))">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|playfair-display:600,700,800" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="@yield('body_class', 'bg-slate-950 text-white')">
        @yield('body')
    </body>
</html>
