<div>

    <x-slot name="titulo">
        Historico Conversiones Monetarias
    </x-slot>

    <x-tabla titulo="Registro de Historico de Conversiones Monetarias">

        <x-tabla.header :encabezados="['Moneda Principal', 'Moneda Secundaria', 'Factor Conversion', 'Fecha']" />

        <tbody class="table-border-bottom-0">
            @forelse ($historicos as $historico)
                <tr>
                    <td class="text-center">
                        {{ $historico->conversionMonetaria->monedaPrincipal->nombre }} ({{ $historico->conversionMonetaria->monedaPrincipal->abreviatura }})
                    </td>
                    <td class="text-center">
                        {{ $historico->conversionMonetaria->monedaSecundaria->nombre }} ({{ $historico->conversionMonetaria->monedaSecundaria->abreviatura }})
                    </td>
                    <td class="text-center">
                        {{ standart_currency_format($historico->monto) }}
                    </td>
                    <td class="text-center">
                        {{ standart_date_format($historico->fecha_actualizacion) }}
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
        {{ $historicos->links() }}
    </div>
</div>
