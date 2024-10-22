<div>

    <x-slot name="titulo">
        Conversiones Monetarias
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de Conversiones Monetarias">

        <x-tabla.header :encabezados="['Moneda Principal', 'Moneda Secundaria', 'Factor Conversion', 'Última Actualización', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($conversiones as $conversion)
                <tr>
                    <td class="text-center">
                        {{ $conversion->monedaPrincipal->nombre }} ({{ $conversion->monedaPrincipal->abreviatura }})
                    </td>
                    <td class="text-center">
                        {{ $conversion->monedaSecundaria->nombre }} ({{ $conversion->monedaSecundaria->abreviatura }})
                    </td>
                    <td class="text-center">
                        {{ standart_currency_format($conversion->cantidad_moneda_secundaria) }}
                    </td>
                    <td class="text-center">
                        {{ standart_date_format($conversion->fecha_actualizacion) }}
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('conversion-monetaria.edit', $conversion->uuid) }}"><i
                                        class="bx bx-edit-alt me-1"></i>
                                    Editar</a>
                                <button class="dropdown-item del-btn" data-module="conversion-monetaria"
                                    data-id="{{ $conversion->uuid }}"><i class="bx bx-trash me-1"></i>
                                    Eliminar</button>
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
        {{ $conversiones->links() }}
    </div>

    @push('scripts')
        @vite(['resources/js/common/delete.js'])
    @endpush
</div>
