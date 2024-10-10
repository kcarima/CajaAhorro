<div>

    <x-slot name="titulo">
        Jornadas Solicitud Prestamo
    </x-slot>
    
    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Jornadas Solicitud Prestamo">
        <x-tabla.header :encabezados="['Fecha Inicio', 'Fecha Cierre', 'Solicitudes','Aprobadas','Rechazadas','Estatus', 'Acciones']" />
        @forelse ($jornadas as $jornada)        
            
        @empty
            <tr>
                <td colspan="7" class="text-center" >
                    <span class="text-gray-900">No existen registros</span>
                </td>
            </tr>
        @endforelse
    </x-tabla>
</div>
