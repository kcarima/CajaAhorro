<x-app-layout titulo="Conceptos">
    <x-slot name="titulo">
        Conceptos
    </x-slot>

    @push('search')
        <livewire:Sca.conceptos.CriterioBusquedaComponent />
    @endpush
    <livewire:Sca.conceptos.storeComponent />
    <livewire:Sca.conceptos.ConceptosComponent />
</x-app-layout>
