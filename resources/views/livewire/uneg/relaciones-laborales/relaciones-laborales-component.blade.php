<div>

    <x-slot name="titulo">
        Relaciones Laborales
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-tabla titulo="Registro de Relaciones Laborales">

        <x-tabla.header :encabezados="['Nombre', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($relaciones_laborales as $relacion)
                <tr>
                    <td class="text-center">
                        <span>
                            {{ $relacion->nombre }}
                        </span>
                        <x-input type="text" name="nombre" class="hidden" value="{{ $relacion->nombre }}" />
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="uuid" value="{{ $relacion->uuid }}">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($relacion->deleted_at == '')
                                    <button class="dropdown-item edit-btn"><i class="bx bx-edit-alt me-1"></i>
                                        Editar</button>
                                    <button class="dropdown-item del-btn"data-module="relaciones-laborales"
                                        data-id="{{ $relacion->uuid }}"><i class="bx bx-trash me-1"></i>
                                        Eliminar</button>
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $relacion->uuid }}"
                                            data-id="{{ $relacion->uuid }}" data-module="relaciones-laborales">
                                            <i class='bx bx-message-alt-x'></i>
                                            Eliminar definitivo</button>
                                    @endif
                                    <button class="dropdown-item hidden save-btn"
                                        data-url={{ route('relaciones-laborales.update', $relacion->uuid) }}>
                                        <i class='bx bx-save'></i>
                                        Guardar</button>
                                    <button class="dropdown-item hidden cancel-btn"><i class='bx bx-x'></i>
                                        Cancelar</button>
                                @else
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item" wire:click="restaurar('{{ $relacion->uuid }}')"
                                            wire:key="2_{{ $relacion->uuid }}"><i class="bx bx-left-arrow-alt me-1"></i>
                                            Restaurar</button>
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $relacion->uuid }}"
                                            data-id="{{ $relacion->uuid }}" data-module="relaciones-laborales">
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
        {{ $relaciones_laborales->links() }}
    </div>


    <template id="template-row">
        <tr>
            <td class="text-center td-nombre">
                <span></span>
                <x-input type="text" name="nombre" class="hidden" />
            </td>
            <td class="text-center">
                <input type="hidden" name="uuid">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item edit-btn"><i class="bx bx-edit-alt me-1"></i>
                            Editar</button>
                        <button class="dropdown-item del-btn" data-module="relaciones-laborales" data-id=""><i
                                class="bx bx-trash me-1"></i>
                            Eliminar</button>
                        @if (auth()->user()->is_root())
                            <button class="dropdown-item del-def-btn" wire:key="1_" data-id=""
                                data-module="relaciones-laborales">
                                <i class='bx bx-message-alt-x'></i>
                                Eliminar definitivo</button>
                        @endif
                        <button class="dropdown-item hidden save-btn">
                            <i class='bx bx-save'></i>
                            Guardar</button>
                        <button class="dropdown-item hidden cancel-btn"><i class='bx bx-x'></i>
                            Cancelar</button>
                    </div>
                </div>
            </td>
        </tr>
    </template>

    <template id="create-row">
        <tr>
            <td class="text-center td-nombre">
                <span></span>
                <x-input type="text" name="nombre" />
            </td>
            <td class="text-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button data-url="{{ route('relaciones-laborales.store') }}" class="dropdown-item">
                            <i class="bx bx-save me-1"></i>
                            Guardar
                        </button>
                        <button class="dropdown-item"><i class="bx bx-x me-1"></i>
                            Cancelar</button>
                    </div>
                </div>
            </td>
        </tr>
    </template>

    @push('scripts')
        @vite(['resources/js/modules/uneg/uneg.js'])
        @vite(['resources/js/common/delete.js'])
    @endpush

</div>
