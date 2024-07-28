<div>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-tabla titulo="Registro Usuarios">

        <x-tabla.header :encabezados="['Usuario', 'Tipo', 'Estatus', 'Última Vez', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('usuarios.show', $usuario->cedula) }}"
                                class="users-list m-0 avatar-group d-flex align-items-center">
                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-md pull-up">
                                    <img src="{{ $usuario->profile_photo_url }}"
                                        alt="profile_photo_{{ $usuario->socio->ficha }}" class="rounded-circle" />
                                </div>
                            </a>
                            <div>
                                <div class="text-sm font-medium">
                                    {{ ucwords(strtolower($usuario->socio->nombre)) }} ({{ $usuario->socio->ficha }})
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $usuario->email }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        {{ $usuario->tipo }}
                    </td>
                    <td class="text-center">
                        <span
                            class="dark:text-green-300 {{ $usuario->status->text_color() }}">{{ $usuario->status->value }}</span>
                    </td>
                    <td class="text-center">
                        @isset($usuario->last_login)
                            {{ standart_date_time_format($usuario->last_login) }}
                        @else
                            -
                        @endisset
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if (!$usuario->trashed())
                                    <a class="dropdown-item" href="{{ route('usuarios.edit', $usuario->cedula) }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Editar</a>
                                    <button class="dropdown-item del-btn" data-module="usuarios"
                                        data-id="{{ $usuario->cedula }}"><i class="bx bx-trash me-1"></i>
                                        Eliminar</button>
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $usuario->cedula }}"
                                            data-id="{{ $usuario->cedula }}" data-module="usuarios">
                                            <i class='bx bx-message-alt-x'></i>
                                            Eliminar definitivo</button>
                                    @endif
                                @else
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item" wire:key="2_{{ $usuario->cedula }}"
                                            wire:click="restaurar('{{ $usuario->cedula }}')"><i
                                                class="bx bx-left-arrow-alt me-1"></i>
                                            Restaurar</button>
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $usuario->cedula }}"
                                            data-id="{{ $usuario->cedula }}" data-module="usuarios">
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
        {{ $usuarios->links() }}
    </div>

    @push('scripts')
        @vite(['resources/js/common/delete.js'])
    @endpush

</div>
