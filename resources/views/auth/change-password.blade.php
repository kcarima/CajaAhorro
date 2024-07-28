<x-guest-layout>

    @section('titulo', 'Cambiar Contraseña')

    <x-authentication-card>
        <x-slot name="logo">
            <x-layouts.authentication-card-logo />
        </x-slot>

        <x-validation-errors />

        <h2 class="text-gray-600 mt-4 text-lg">Por favor ingrese una nueva contraseña</h2>

        <form method="POST" action="{{ route('reinicializar.password') }}">
            @csrf

            <x-honeypot/>

            <div class="mt-4">
                <x-label for="password" value="Nueva Contraseña" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="Confirmar Contraseña" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <button type="submit"
                class="bg-blue-700 rounded-md px-4 py-2 uppercase text-xs
                    text-white tracking-widest hover:bg-blue-500 active:bg-blue-900"
                >
                    Reiniciar contraseña
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
