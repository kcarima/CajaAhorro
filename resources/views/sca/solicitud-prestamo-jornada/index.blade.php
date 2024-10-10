<x-app-layout titulo="Jornadas de Solicitud Prestamos">
    <x-slot name="titulo">
        Jornadas de Solicitud Prestamos
    </x-slot>

    @push('search')            
        <livewire:Sca.solicitud-prestamo-jornada.CriterioBusquedaComponent />
    @endpush
    <livewire:Sca.solicitud-prestamo-jornada.create-modal-component />
    <livewire:Sca.solicitud-prestamo-jornada.solicitud-prestamo-jornada-component />
</x-app-layout>
