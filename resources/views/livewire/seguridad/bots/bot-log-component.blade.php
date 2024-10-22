<div>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-tabla titulo="Registro de Actividades Sospechosas">

        <x-tabla.header :encabezados="['IP', 'User Agent', 'Fecha']" />

        <tbody class="table-border-bottom-0">
            @forelse ($logs as $log)
                <tr>
                    <td class="text-center">
                        {{ $log->ip }}
                    </td>
                    <td class="text-center">
                        {{ $log->user_agent }}
                    </td>
                    <td class="text-center">
                        {{ standart_date_time_format($log->created_at) }}
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
        {{ $logs->links() }}
    </div>

</div>
