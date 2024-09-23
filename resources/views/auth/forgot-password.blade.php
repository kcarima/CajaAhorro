<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-layouts.authentication-card-logo />
        </x-slot>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-form.validation-error-template />

        <div class="mb-4 text-sm text-gray-600 text-justify">
            ¿Olvidaste tu contraseña? No hay problema. Simplemente háganos saber su número de cédula y le enviaremos un correo electrónico con un enlace para restablecer la contraseña que le permitirá elegir una nueva.
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <x-honeypot/>
            <div class="block">
                <x-label for="cedula" value="Cédula" />
                <x-input id="cedula" class="block mt-1 w-full" type="text" name="cedula" :value="old('cedula')" required autofocus />
            </div>

            <x-captcha/>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
