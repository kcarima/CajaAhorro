<x-app-layout titulo="Configuraciones">

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de Configuraciones">

        <x-tabla.header :encabezados="['Configuración', 'Valor', 'Última Actualización', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($configuraciones as $configuracion)
                <tr>
                    <td>
                        {{ $configuracion->clave }}
                    </td>
                    <td class="text-center">
                        @switch($configuracion->tipo)
                            @case('IMAGEN')
                                @if ($configuracion->valor != '')
                                    <a class="enlace-img" target="_blank" href="{{ Storage::url($configuracion->valor) }}">
                                        <span>
                                            {{ $configuracion->valor }}
                                        </span>
                                    </a>
                                @else
                                    <span>
                                        {{ $configuracion->valor }}
                                    </span>
                                @endif
                                <input type="file" name="valor" class="hidden" accept="image/*">
                            @break

                            @case('TEXTO')
                                <span>
                                    {{ $configuracion->valor }}
                                </span>
                                <x-input type="text" name="valor" class="hidden" value="{{ $configuracion->valor }}" />
                            @break

                            @case('NUMERO')
                                <span>
                                    {{ $configuracion->valor }}
                                </span>
                                <x-input type="number" name="valor" class="hidden" step="0.1"
                                    value="{{ $configuracion->valor }}" />
                            @break

                            @default
                                {{ $configuracion->valor }}
                                <x-input type="text" name="valor" class="hidden" value="{{ $configuracion->valor }}" />
                        @endswitch

                        <span>
                        </span>
                    </td>
                    <td class="text-center">
                        {{ standart_date_time_format($configuracion->updated_at) }}
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item edit-btn"><i class="bx bx-edit-alt me-1"></i>
                                    Editar</button>
                                <button class="dropdown-item hidden save-btn"
                                    data-url="{{ route('configuraciones.update', $configuracion->id) }}"><i
                                        class='bx bx-save'></i>
                                    Guardar</button>
                                <button class="dropdown-item hidden cancel-btn"><i class='bx bx-x'></i>
                                    Cancelar</button>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <span class="text-gray-900">No existen registros</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-tabla>

        @push('scripts')
            @vite(['resources/js/modules/sca/configuraciones/configuraciones.js'])
        @endpush

    </x-app-layout>
