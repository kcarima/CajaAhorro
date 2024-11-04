<div>
    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    @if (session('message'))
        <x-utils.alert :message="session('message')" type="success" />    
    @endif
    <x-form.validation-error-template />

    <x-tabla titulo="Bandeja de Solicitudes de Prestamos">
        <x-tabla.header :encabezados="['Fecha Solicitud', 'Tipo de Prestamo', 'Monto','Amortizado','Estatus', 'Acciones']" />
        @forelse ($solicitudes as $solicitud)
        @php
            $fecha = explode('-',$solicitud->fecha_solicitud);
        @endphp
            <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                <td class="text-center td-codigo " style="font-size: 10 !important;">
                    {{  $fecha[2] }}/{{  $fecha[1] }}/{{  $fecha[0] }}
                </td>
                <td class="text-center td-codigo" style="font-size: 10 !important;">
                    [{{ $solicitud->tipoPrestamo->codigo }}] - {{ $solicitud->tipoPrestamo->nombre }}
                </td>
                <td class="text-right td-codigo" style="font-size: 10 !important;">
                    {{ number_format($solicitud->monto, 2, ",", ".") }}
                </td>
                <td class="text-right td-codigo" style="font-size: 10 !important;">
                {{ number_format(0, 2, ",", ".") }}
                </td>
                <td class="text-center td-codigo" style="font-size: 10 !important;">
                    @if ($solicitud->status == 0)
                        <button type="button" class="btn btn-sm btn-orange">PENDIENTE</button>                        
                    @elseif ($solicitud->status == 1)
                        <button type="button" class="btn btn-sm btn-success">APROBADA</button>
                    @else
                        <button type="button" class="btn btn-sm btn-danger">RECHAZADA</button>
                    @endif                    
                </td>
                <td class="text-center td-codigo" style="font-size: 10 !important;">
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" wire:click="editarSp({{$solicitud->id}})" style="cursor:pointer !important;"><i
                                class="bx bx-edit-alt me-1" ></i>
                            Editar</a>
                            @if ( $solicitud->status == 0 )
                                <a class="dropdown-item" wire:click="eliminarSp({{$solicitud->id}})" style="cursor:pointer !important;"><i
                                    class="bx bx-trash me-1" ></i>
                                Eliminar</a>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center" >
                    <span class="text-gray-900">No existen registros</span>
                </td>
            </tr>
        @endforelse
        <tr>
            <td colspan="7" class="text-center" >
                <span style="display: flex !important;align-items: center !important;justify-content: center !important;">{{ $solicitudes->links() }}</span>
            </td>
        </tr>
    </x-tabla>
    <style>
        .btn-orange {
            background-color: #FFA500; /* Orange color */
            border-color: #FFA500;
        }
    </style>
</div>
