<div>

    <x-slot name="titulo">
        Monedas
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de Monedas">

        <x-tabla.header :encabezados="['Nombre', 'Abreviatura', 'ISO 4217', 'Año Vigencia', 'Activa', 'Default', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($monedas as $moneda)
                <tr>
                    <td class="text-center">
                        <span>
                            {{ ucwords(strtolower($moneda->nombre)) }}
                        </span>
                        <x-input type="text" name="nombre" class="hidden" value="{{ $moneda->nombre }}" />
                    </td>
                    <td class="text-center">
                        <span>
                            {{ $moneda->abreviatura }}
                        </span>
                        <x-input type="text" name="abreviatura" class="hidden" value="{{ $moneda->abreviatura }}" />
                    </td>
                    <td class="text-center">
                        <span>
                            {{ $moneda->iso_4217 }}
                        </span>
                        <x-input type="text" name="iso" class="hidden" value="{{ $moneda->iso_4217 }}" />
                    </td>
                    <td class="text-center">
                        <span>
                            {{ $moneda->anio }}
                        </span>
                        <x-input type="text" name="anio" class="hidden" value="{{ $moneda->anio }}" />
                    </td>
                    <td class="text-center">
                        @if ($moneda->es_activa)
                            <span class="text-green-500 font-bold">Sí</span>
                            <input type="checkbox" name="activa" checked id="activa" class="hidden">
                        @else
                            <span class="text-red-500 font-bold">No</span>
                            <input type="checkbox" name="activa" id="activa" class="hidden">
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($moneda->es_default)
                            <span class="text-green-500 font-bold">Sí</span>
                            <input type="checkbox" name="default" checked id="default" class="hidden">
                        @else
                            <span class="text-red-500 font-bold">No</span>
                            <input type="checkbox" name="default" id="default" class="hidden">
                        @endif
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="uuid" value="{{ $moneda->uuid }}">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($moneda->deleted_at == '')
                                    <button class="dropdown-item edit-btn"><i class="bx bx-edit-alt me-1"></i>
                                        Editar</button>
                                    <button class="dropdown-item del-btn" data-module="monedas"
                                        data-id="{{ $moneda->uuid }}"><i class="bx bx-trash me-1"></i>
                                        Eliminar</button>
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $moneda->uuid }}"
                                            data-id={{ $moneda->uuid }} data-module="monedas">
                                            <i class='bx bx-message-alt-x'></i>
                                            Eliminar definitivo</button>
                                    @endif
                                    <button class="dropdown-item hidden save-btn"
                                        data-url={{ route('monedas.update', $moneda->uuid) }}>
                                        <i class='bx bx-save'></i>
                                        Guardar</button>
                                    <button class="dropdown-item hidden cancel-btn"><i class='bx bx-x'></i>
                                        Cancelar</button>
                                @else
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item" wire:key="2_{{ $moneda->uuid }}"
                                            wire:click="restaurar('{{ $moneda->uuid }}')"><i
                                                class="bx bx-left-arrow-alt me-1"></i>
                                            Restaurar</button>
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $moneda->uuid }}"
                                            data-id={{ $moneda->uuid }} data-module="monedas">
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
        {{ $monedas->links() }}
    </div>

    <template id="template-row">
        <tr>
            <td class="text-center">
                <span></span>
                <x-input type="text" name="nombre" class="hidden" />
            </td>
            <td class="text-center">
                <span></span>
                <x-input type="text" name="abreviatura" class="hidden" />
            </td>
            <td class="text-center">
                <span></span>
                <x-input type="text" name="iso" class="hidden" />
            </td>
            <td class="text-center">
                <span></span>
                <x-input type="text" name="anio" class="hidden" />
            </td>
            <td class="text-center">
                <span class="font-bold"></span>
                <input type="checkbox" name="activa" class="hidden">
            </td>
            <td class="text-center">
                <span class="font-bold"></span>
                <input type="checkbox" name="default" class="hidden">
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
                        <button class="dropdown-item del-btn" data-module="monedas" data-id=""><i
                                class="bx bx-trash me-1"></i>
                            Eliminar</button>
                        @if (auth()->user()->is_root())
                            <button class="dropdown-item del-def-btn" wire:key="1_" data-id=""
                                data-module="monedas">
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
            <td class="text-center">
                <x-input type="text" name="nombre" />
            </td>
            <td class="text-center">
                <x-input type="text" name="abreviatura" />
            </td>
            <td class="text-center">
                <x-input type="text" name="iso" />
            </td>
            <td class="text-center">
                <x-input type="text" name="anio" />
            </td>
            <td class="text-center">
                <input type="checkbox" name="activa">
            </td>
            <td class="text-center">
                <input type="checkbox" name="default">
            </td>
            <td class="text-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button data-url="{{ route('monedas.store') }}" class="dropdown-item">
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
