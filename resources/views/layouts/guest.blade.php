<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <style>
        body {
            background: radial-gradient(circle at 10% 20%, rgb(120, 50, 255) 0%, rgb(50, 150, 250) 91%);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center">
    <div class="font-sans text-gray-900 antialiased w-11/12">

        <div class="flex flex-col gap-2 justify-center items-center">
            {{ $slot }}
        </div>

    </div>

    <x-form.validation-error-template/>

    @include('templates.form.character-counter')
    @stack('scripts')

</body>

</html>
