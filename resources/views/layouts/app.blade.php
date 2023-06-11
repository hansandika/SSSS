<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Icon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-poppins">
    <x-navbar />
    <main class="bg-earth">
        <div class="max-w-4xl min-h-screen py-8 mx-6 md:mx-auto">
            <x-alert />
            {{ $slot }}
        </div>
    </main>
    <x-footer />
    @stack('scripts')
</body>

</html>
