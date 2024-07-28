<x-app-layout titulo="Registro IP Bloqueada">

    @push('search')
        <x-utils.buscador modulo="block-ip" />
    @endpush

    @livewire('seguridad.bots.block-ip-component')

</x-app-layout>
