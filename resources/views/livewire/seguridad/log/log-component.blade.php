<div>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-tabla titulo="Registro de Actividades">

        <x-tabla.header :encabezados="['Canal', 'Descripcion', 'Causante', 'Fecha', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($actividades as $actividad)
                <tr>
                    <td class="text-center">
                        {{ $actividad->log_name }}
                    </td>
                    <td class="text-center">
                        {{ $actividad->description }}
                    </td>
                    <td class="text-center">
                        <div class="flex gap-2 items-center justify-center">
                            <span class="inline-block w-8 h-8 bg-no-repeat rounded-full bg-clip-content bg-center"
                                style="background-image: url({{ $actividad->causer ? $actividad->causer->profile_photo_url : get_logo_sistema() }});
                                        background-size: 2rem;
                                        border: .01rem solid blue;
                                        ">

                            </span>
                            <span class="causer">
                                {{ $actividad->causer ? $actividad->causer->socio->nombre : 'Sistema' }}
                            </span>
                        </div>
                    </td>
                    <td class="text-center">
                        {{ standart_date_time_format($actividad->created_at) }}
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('log.show', $actividad->id) }}"><i
                                        class="bx bx-show me-1"></i>
                                    Detalle</a>
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
        {{ $actividades->links() }}
    </div>

</div>
