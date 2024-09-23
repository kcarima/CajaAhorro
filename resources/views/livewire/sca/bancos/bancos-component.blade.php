<div>

    <x-slot name="titulo">
        Bancos
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de bancos" id="tabla">

        <x-tabla.header :encabezados="['codigo', 'nombre', 'abreviatura', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($bancos as $banco)
                <tr>
                    <td class="text-center td-codigo">
                        <span>
                            {{ $banco->codigo }}
                        </span>
                        <x-input type="text" name="codigo" class="hidden" value="{{ $banco->codigo }}" />
                    </td>
                    <td class="text-center">
                        <span>
                            {{ $banco->nombre }}
                        </span>
                        <x-input type="text" name="nombre" class="hidden" value="{{ $banco->nombre }}" />
                    </td>
                    <td class="text-center">
                        <span>
                            {{ $banco->abreviatura }}
                        </span>
                        <x-input type="text" name="abreviatura" class="hidden" value="{{ $banco->abreviatura }}" />
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <input type="hidden" name="uuid" value="{{ $banco->uuid }}">
                                @if ($banco->deleted_at == '')
                                    <button class="dropdown-item edit-btn">
                                        <i class="bx bx-edit-alt me-1"></i>
                                        Editar
                                    </button>
                                    <button class="dropdown-item del-btn" data-module="bancos"
                                        data-id="{{ $banco->uuid }}"><i class="bx bx-trash me-1"></i>
                                        Eliminar</button>
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $banco->uuid }}"
                                            data-id="{{ $banco->uuid }}" data-module="bancos">
                                            <i class='bx bx-message-alt-x'></i>
                                            Eliminar definitivo</button>
                                    @endif
                                    <button class="dropdown-item hidden save-btn"
                                        data-url={{ route('bancos.update', $banco->uuid) }}>
                                        <i class='bx bx-save'></i>
                                        Guardar</button>
                                    <button class="dropdown-item hidden cancel-btn"><i class='bx bx-x'></i>
                                        Cancelar</button>
                                @else
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item" wire:key="2_{{ $banco->uuid }}" wire:click="restaurar('{{ $banco->uuid }}')"><i class="bx bx-left-arrow-alt me-1"></i>
                                            Restaurar</button>
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $banco->uuid }}"
                                            data-id="{{ $banco->uuid }}" data-module="bancos">
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
        {{ $bancos->links() }}
    </div>

    <template id="template-row">
        <tr>
            <td class="text-center td-codigo">
                <span></span>
                <x-input type="text" name="codigo" class="hidden" />
            </td>
            <td class="text-center td-nombre">
                <span></span>
                <x-input type="text" name="nombre" class="hidden" />
            </td>
            <td class="text-center td-abreviatura">
                <span></span>
                <x-input type="text" name="abreviatura" class="hidden" />
            </td>
            <td class="text-center">
                <input type="hidden" name="uuid">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item edit-btn">
                            <i class="bx bx-edit-alt me-1"></i>
                            Editar
                        </button>
                        <button class="dropdown-item del-btn" data-module="bancos" data-id=""><i
                                class="bx bx-trash me-1"></i>
                            Eliminar</button>
                        @if (auth()->user()->is_root())
                            <button class="dropdown-item del-def-btn" wire:key="1_"
                                data-id="" data-module="bancos">
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
            <td class="text-center td-codigo">
                <x-input type="text" name="codigo" />
            </td>
            <td class="text-center td-nombre">
                <x-input type="text" name="nombre" />
            </td>
            <td class="text-center td-abreviatura">
                <x-input type="text" name="abreviatura" />
            </td>
            <td class="text-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button data-url="{{ route('bancos.store') }}" class="dropdown-item">
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
