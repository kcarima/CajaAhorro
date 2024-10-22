<x-app-layout>

    @push('search')
        <x-utils.buscador modulo="reconversion" />
    @endpush

    @livewire('sca.reconversion.reconversion-component')

</x-app-layout>
