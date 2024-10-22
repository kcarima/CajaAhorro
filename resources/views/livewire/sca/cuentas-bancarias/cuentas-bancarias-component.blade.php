<div>

    <x-slot name="titulo">
        Cuentas Bancarias
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de Cuentas Bancarias">

        <x-tabla.header :encabezados="['Banco', 'Agencia', 'Tipo de Cuenta', 'Saldo', 'Número de Cuenta', 'Pública', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($cuentasBancarias as $cuenta)
                <tr>
                    <td class="text-center td-codigo">
                        {{ $cuenta->banco->nombre }}
                    </td>
                    <td>
                        {{ $cuenta->agencia }}
                    </td>
                    <td class="text-center">
                        {{ $cuenta->tipoCuentaBancaria->nombre }}
                    </td>
                    <td class="text-center">
                        {{ $cuenta->saldo }} <abbr
                            title="{{ $cuenta->moneda->nombre }}">{{ $cuenta->moneda->abreviatura }}</abbr>
                    </td>
                    <td class="text-center">
                        {{ $cuenta->numero }}
                    </td>
                    <td class="text-center">
                        @if ($cuenta->is_public)
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
                                @if ($cuenta->deleted_at == '')
                                <a class="dropdown-item" href="{{ route('cuenta-bancaria.edit', $cuenta->uuid) }}"><i
                                    class="bx bx-edit-alt me-1"></i>
                                Editar</a>
                                    <button class="dropdown-item del-btn" data-module="cuenta-bancaria"
                                        data-id="{{ $cuenta->uuid }}"><i class="bx bx-trash me-1"></i>
                                        Eliminar</button>
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $cuenta->uuid }}"
                                            data-id="{{ $cuenta->uuid }}" data-module="cuenta-bancaria">
                                            <i class='bx bx-message-alt-x'></i>
                                            Eliminar definitivo</button>
                                    @endif
                                @else
                                    @if (auth()->user()->is_root())
                                        <button class="dropdown-item" wire:key="2_{{ $cuenta->uuid }}" wire:click="restaurar('{{ $cuenta->uuid }}')"><i class="bx bx-left-arrow-alt me-1"></i>
                                            Restaurar</button>
                                        <button class="dropdown-item del-def-btn" wire:key="1_{{ $cuenta->uuid }}"
                                            data-id="{{ $cuenta->uuid }}" data-module="cuenta-bancaria">
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
        {{ $cuentasBancarias->links() }}
    </div>

    @push('scripts')
        @vite(['resources/js/common/delete.js'])
    @endpush
</div>
