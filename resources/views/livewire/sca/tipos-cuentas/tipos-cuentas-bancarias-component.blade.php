<div>

    <x-slot name="titulo">
        Tipos Cuentas
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de Tipos de Cuentas">

        <x-tabla.header :encabezados="['Nombre', 'Público', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($tipos_cuentas as $tipo)
                <tr>
                    <td class="text-center">
                        <span>
                            {{ $tipo->nombre }}
                        </span>
                        <x-input type="text" name="nombre" class="hidden" value="{{ $tipo->nombre }}" />
                    </td>
                    <td class="text-center">
                        @if ($tipo->is_public)
                            <span class="text-green-500 font-bold">Sí</span>
                            <input type="checkbox" name="publico" checked id="publico" class="hidden">
                            @else
                            <span class="text-red-500 font-bold">No</span>
                            <input type="checkbox" name="publico" id="publico" class="hidden">
                        @endif
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="uuid" value="{{ $tipo->uuid }}">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($tipo->deleted_at == '')
                                    <button class="dropdown-item edit-btn"><i class="bx bx-edit-alt me-1"></i>
                                        Editar</button>
                                    <button class="dropdown-item del-btn" data-module="tipos-cuentas"
                                        data-id="{{ $tipo->uuid }}"><i class="bx bx-trash me-1"></i>
                                        Eliminar</button>
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $tipo->uuid }}"
                                            data-id={{ $tipo->uuid }} data-module="tipos-cuentas">
                                            <i class='bx bx-message-alt-x'></i>
                                            Eliminar definitivo</button>
                                    @endif
                                    <button class="dropdown-item hidden save-btn"
                                        data-url={{ route('tipos-cuentas.update', $tipo->uuid) }}>
                                        <i class='bx bx-save'></i>
                                        Guardar</button>
                                    <button class="dropdown-item hidden cancel-btn"><i class='bx bx-x'></i>
                                        Cancelar</button>
                                @else
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item" wire:key="2_{{ $tipo->uuid }}"
                                            wire:click="restaurar('{{ $tipo->uuid }}')"><i
                                                class="bx bx-left-arrow-alt me-1"></i>
                                            Restaurar</button>
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $tipo->uuid }}"
                                            data-id={{ $tipo->uuid }} data-module="tipos-cuentas">
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
        {{ $tipos_cuentas->links() }}
    </div>

    <template id="template-row">
        <tr>
            <td class="text-center td-nombre">
                <span></span>
                <x-input type="text" name="nombre" class="hidden" />
            </td>
            <td class="text-center td-checkbox">
                <span></span>
                <x-input type="checkbox" name="publico" class="hidden" />
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
                        <button class="dropdown-item del-btn" data-module="tipos-cuentas" data-id=""><i
                                class="bx bx-trash me-1"></i>
                            Eliminar</button>
                        @if (auth()->user()->is_root())
                            <button class="dropdown-item del-def-btn" wire:key="1_" data-id=""
                                data-module="tipos-cuentas">
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
                <x-input type="text" name="nombre" />
            </td>
            <td class="text-center td-nombre">
                <input type="checkbox" name="publico" checked>
            </td>
            <td class="text-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button data-url="{{ route('tipos-cuentas.store') }}" class="dropdown-item">
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
