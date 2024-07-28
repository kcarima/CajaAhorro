<x-app-layout titulo="Registro Actividades Sospechosas">

    @push('search')
        <x-utils.buscador modulo="bot-log" />
    @endpush

    @livewire('seguridad.bots.bot-log-component')

</x-app-layout>
