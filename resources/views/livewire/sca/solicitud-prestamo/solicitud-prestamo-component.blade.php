<div>

    <x-form.validation-error-template />

    <x-tabla titulo="Bandeja de Solicitudes de Prestamos">
        <x-tabla.header :encabezados="['Fecha Solicitud', 'Tipo de Prestamo', 'Socio', 'Moneda', 'Monto','Estatus', 'Acciones']" />
        @forelse ($solicitudes as $solicitud)
        @php
            $fecha = explode('-',$solicitud->fecha_solicitud);
        @endphp
            <tr>
                <td class="text-center td-codigo " style="font-size: 10 !important;">
                    {{  $fecha[2] }}/{{  $fecha[1] }}/{{  $fecha[0] }}
                </td>
                <td class="text-center td-codigo" style="font-size: 10 !important;">
                    [{{ $solicitud->tipoPrestamo->codigo }}] - {{ $solicitud->tipoPrestamo->nombre }}
                </td>
                <td class="text-center td-codigo" style="font-size: 10 !important;">
                    {{ $solicitud->ficha }}
                </td>
                <td class="text-center td-codigo" style="font-size: 10 !important;">
                    {{ $solicitud->Moneda->abreviatura }}
                </td>
                <td class="text-right td-codigo" style="font-size: 10 !important;">
                    {{ number_format($solicitud->monto, 2, ",", ".") }}
                </td>
                <td class="text-center td-codigo" style="font-size: 10 !important;">
                    {{ $solicitud->status }}
                </td>
                <td class="text-center td-codigo" style="font-size: 10 !important;">
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href=""><i
                                class="bx bx-edit-alt me-1"></i>
                            Detalle</a>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">
                    <span class="text-gray-900">No existen registros</span>
                </td>
            </tr>
        @endforelse
    </x-tabla>
    {{ $solicitudes->links() }}
</div>