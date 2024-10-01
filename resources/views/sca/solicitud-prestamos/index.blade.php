<div>
    <x-app-layout>
        <x-slot name="titulo">
            Solicitud Prestamo
        </x-slot>
        @livewire('Sca.solicitud-prestamo.CriterioBusquedaComponent')
        <br>
        @livewire('Sca.solicitud-prestamo.solicitudPrestamoComponent')
    </x-app-layout>
</div>