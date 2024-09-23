<div>

    <x-slot name="titulo">
        Tipos Prestamos
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de Tipos de Prestamos">

        <x-tabla.header :encabezados="['Nombre', 'Cantidad Cuotas', 'Tasa Interés', 'Cuota Especial', 'Habilitado', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($tiposPrestamos as $tipo)
                <tr>
                    <td class="text-center">
                        {{ $tipo->nombre }} ({{ $tipo->codigo }})
                    </td>
                    <td class="text-center">
                        {{ $tipo->cantidad_cuotas }}
                    </td>
                    <td class="text-center">
                        {{ $tipo->tasa_interes }}
                    </td>
                    <td class="text-center">
                        @if ($tipo->cuota_especial)
                            <span class="text-green-500 font-bold">Sí</span>
                        @else
                            <span class="text-red-500 font-bold">No</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($tipo->habilitar)
                            <span class="text-green-500 font-bold">Sí</span>
                        @else
                            <span class="text-red-500 font-bold">No</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($tipo->deleted_at == '')
                                <a class="dropdown-item" href="{{ route('tipo-prestamo.edit', $tipo->uuid) }}"><i
                                    class="bx bx-edit-alt me-1"></i>
                                Editar</a>
                                    <button class="dropdown-item del-btn" data-module="tipo-prestamo"
                                        data-id="{{ $tipo->uuid }}"><i class="bx bx-trash me-1"></i>
                                        Eliminar</button>
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $tipo->uuid }}"
                                            data-id={{ $tipo->uuid }} data-module="tipo-prestamo">
                                            <i class='bx bx-message-alt-x'></i>
                                            Eliminar definitivo</button>
                                    @endif
                                @else
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item" wire:key="2_{{ $tipo->uuid }}"
                                            wire:click="restaurar('{{ $tipo->uuid }}')"><i
                                                class="bx bx-left-arrow-alt me-1"></i>
                                            Restaurar</button>
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $tipo->uuid }}"
                                            data-id={{ $tipo->uuid }} data-module="tipo-prestamo">
                                            <i class='bx bx-message-alt-x'></i>
                                            Eliminar definitivo</button>
                                    @endif
                                @endif
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
        {{ $tiposPrestamos->links() }}
    </div>

    @push('scripts')
        @vite(['resources/js/common/delete.js'])
    @endpush
</div>
