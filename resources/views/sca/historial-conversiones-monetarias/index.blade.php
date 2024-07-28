<x-app-layout>

    @push('search')
        <x-utils.buscador modulo="historial-conversion-monetaria" />
    @endpush

    @livewire('sca.conversion-monetaria.historial-conversion-monetaria-component')

</x-app-layout>
