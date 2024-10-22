<div>

    <x-slot name="titulo">
        Solicitudes Ingreso
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de Solicitudes de Ingreso">

        <x-tabla.header :encabezados="['Nombre', 'Ficha', 'Cédula', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($solicitudes as $solicitud)
                <tr>
                    <td class="text-center td-codigo">
                        {{ $solicitud->nombre }}
                    </td>
                    <td class="text-center">
                        {{ $solicitud->ficha }}
                    </td>
                    <td class="text-center">
                        {{ $solicitud->cedula }}
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('cuenta-bancaria.edit', $solicitud->uuid) }}"><i
                                    class="bx bx-edit-alt me-1"></i>
                                Detalle</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <span class="text-gray-900">No existen registros</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </x-tabla>

    <div class="flex justify-center mt-4 mb-4">
        {{ $solicitudes->links() }}
    </div>
</div>
