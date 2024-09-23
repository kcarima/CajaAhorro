<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

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

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="font-sans text-gray-900 antialiased w-11/12">

        <div class="flex justify-center items-center">
            <section class="grid lg:grid-cols-2 grid-cols-1 w-10/12 bg-white rounded-xl h-[500px]">

                <article class="lg:flex items-center justify-center flex-col gap-4 hidden">
                    @if ($nombre_sistema != '')
                        <h1 class="text-center text-xl font-extrabold">{{ $nombre_sistema->valor }}</h1>
                    @endif
                    @if ($logo_sistema->valor != '')
                        <img class="w-1/2" src="{{ Storage::disk('public')->url($logo_sistema->valor) }}"
                            alt="logo">
                    @endif
                </article>

                <article class="p-8">

                    @if (session('success'))
                        <x-utils.alert :message="session('success')" type="success" />
                    @elseif (session('error'))
                        <x-utils.alert :message="session('error')" type="error" />
                    @endif

                    <x-validation-errors />

                    <h2 class="text-center text-xl font-extrabold mb-4">Inicio de Sesión</h2>

                    <form method="POST" action="{{ route('login') }}" class="p-4">
                        @csrf

                        <div>
                            <x-input id="cedula" type="text" class="block mt-1 w-full" name="cedula"
                                :value="old('cedula')" autocomplete="cedula" placeholder="{{ __('Cédula') }}" required
                                autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="current-password" placeholder="{{ __('Password') }}" />
                        </div>

                        <x-captcha />

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <x-honeypot />

                        <div class="flex items-center justify-end flex-col-reverse gap-4 mt-6">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-button class="w-7/12">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </article>
            </section>
        </div>

    </div>

    @stack('scripts')

</body>

</html>
