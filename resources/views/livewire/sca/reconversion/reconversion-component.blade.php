<div>

    <x-slot name="titulo">
        Reconversión
    </x-slot>

    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    <x-form.validation-error-template />

    <x-tabla titulo="Registro de Reconversiones">

        <x-tabla.header :encabezados="['Descripcion', 'Acciones']" />

        <tbody class="table-border-bottom-0">
            @forelse ($tablas as $tabla)
                <tr>
                    <td class="text-center">
                        <span>
                            {{ $tabla->descripcion }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                href="{{ route('reconversion.get', $tabla->uuid) }}"><i class='bx bx-money-withdraw'></i>
                                Reconvertir</a>
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
        {{ $tablas->links() }}
    </div>

</div>
