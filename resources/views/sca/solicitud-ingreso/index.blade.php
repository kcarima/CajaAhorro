<x-app-layout>

    @push('search')
        <x-utils.buscador modulo="solicitud-ingreso" />
    @endpush

    @livewire('sca.solicitud-ingreso.solicitud-ingreso-component')

</x-app-layout>
