<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $store->description ?? 'Selamat datang di toko kami.' }}">
        <title>{{ $store->name ?? 'Store' }} - UMKM Connect</title>
        
        <!-- Dynamic Theme Colors -->
        <style>
            :root {
                --primary-color: {{ $store->color ?? '#6366F1' }};
            }
        </style>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 font-sans antialiased text-slate-900">
        {{ $slot }}
    </body>
</html>
