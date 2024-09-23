<x-app-layout titulo="Registro Actividades">

    @push('search')
        <x-utils.buscador modulo="log" />
    @endpush

    @livewire('seguridad.log.log-component')

</x-app-layout>
