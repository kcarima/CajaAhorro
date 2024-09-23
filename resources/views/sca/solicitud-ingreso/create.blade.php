<x-guest-layout>
    <header class="flex items-center gap-2">
        <img class="w-32 h-32" src="{{ get_logo_sistema() }}" alt="logo cauneg">
        <span class="text-xl font-bold">
            {{ getNombreSistema() }}
        </span>
    </header>
    <section class="w-10/12 bg-white rounded-xl">
        <article class="p-8">

            @if (session('success'))
                <x-utils.alert :message="session('success')" type="success" />
            @elseif (session('error'))
                <x-utils.alert :message="session('error')" type="error" />
            @endif

            <h2 class="text-center text-xl font-extrabold mb-4">Solicitud de Ingreso</h2>

            @include('sca.solicitud-ingreso.partials.form')

            @push('scripts')
                @vite(['resources/js/modules/seguridad/usuarios/registro.js'])
            @endpush

        </article>
    </section>
</x-guest-layout>
