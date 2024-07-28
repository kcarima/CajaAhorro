<div>

    <x-slot name="titulo">
        Parentesco
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de Parentescos">

        <x-tabla.header :encabezados="['Nombre', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($parentescos as $parentesco)
                <tr>
                    <td class="text-center">
                        <span>
                            {{ $parentesco->nombre }}
                        </span>
                        <x-input type="text" name="nombre" class="hidden" value="{{ $parentesco->nombre }}" />
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="uuid" value="{{ $parentesco->uuid }}">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($parentesco->deleted_at == '')
                                    <button class="dropdown-item edit-btn"><i class="bx bx-edit-alt me-1"></i>
                                        Editar</button>
                                    <button class="dropdown-item del-btn" data-module="parentesco"
                                        data-id="{{ $parentesco->uuid }}"><i class="bx bx-trash me-1"></i>
                                        Eliminar</button>
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $parentesco->uuid }}"
                                            data-id={{ $parentesco->uuid }} data-module="parentesco">
                                            <i class='bx bx-message-alt-x'></i>
                                            Eliminar definitivo</button>
                                    @endif
                                    <button class="dropdown-item hidden save-btn"
                                        data-url={{ route('parentesco.update', $parentesco->uuid) }}>
                                        <i class='bx bx-save'></i>
                                        Guardar</button>
                                    <button class="dropdown-item hidden cancel-btn"><i class='bx bx-x'></i>
                                        Cancelar</button>
                                @else
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item" wire:key="2_{{ $parentesco->uuid }}"
                                            wire:click="restaurar('{{ $parentesco->uuid }}')"><i
                                                class="bx bx-left-arrow-alt me-1"></i>
                                            Restaurar</button>
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $parentesco->uuid }}"
                                            data-id={{ $parentesco->uuid }} data-module="parentesco">
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
        {{ $parentescos->links() }}
    </div>

    <template id="template-row">
        <tr>
            <td class="text-center td-nombre uppercase">
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
                        <button class="dropdown-item del-btn" data-module="parentesco" data-id=""><i
                                class="bx bx-trash me-1"></i>
                            Eliminar</button>
                        @if (auth()->user()->is_root())
                            <button class="dropdown-item del-def-btn" wire:key="1_" data-id=""
                                data-module="parentesco">
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
            <td class="text-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button data-url="{{ route('parentesco.store') }}" class="dropdown-item">
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
