<x-app-layout titulo="Carga de Archivos SINU">
    <x-slot name="titulo">
        Carga de Archivos SINU
    </x-slot>
    @push('search')
        <livewire:Sca.ArchivoSinu.CriterioBusquedaComponent />
    @endpush
    <livewire:Sca.ArchivoSinu.StoreComponent />
    <livewire:Sca.ArchivoSinu.ArchivoSinuComponent />
</x-app-layout>
