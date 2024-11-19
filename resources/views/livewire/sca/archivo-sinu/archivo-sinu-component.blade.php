<div>
    @php
        use Carbon\Carbon;
    @endphp
    <x-slot name="titulo">
        Carga de Archivo SINU
    </x-slot>
    
    @if (session('success'))
        <x-utils.alert :message="session('success')" type="success" />
    @elseif (session('error'))
        <x-utils.alert :message="session('error')" type="error" />
    @endif

    @if (session('message'))
        <x-utils.alert :message="session('message')" type="success" />    
    @endif

    <x-form.validation-error-template />
    <x-tabla titulo="Archivos SINU">
        <x-tabla.header :encabezados="['Fecha', 'Descripción', 'Monto', 'Estatus', 'Acciones']" />
        @forelse ($archivos as $archivo)
            <tr>
                <td class="text-center small">{{$archivo->fecha}}</td>
                <td class="text-left small">{{$archivo->descripcion}}</td> 
                <td class="text-right td-codigo" style="font-size: 10 !important;">{{ number_format($archivo->monto, 2, ",", ".") }}</td>
                <td class="text-center small">
                    @if( $archivo->status == 0)
                        <p class="text-warning">Cargado</p>
                    @else
                        <p class="text-success">Procesado</p>
                    @endif
                </td>
                <td class="text-center small">
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" style="cursor:pointer !important;"><i class="bx bx-search-alt me-1"></i>Detalle</a>                            
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center" >
                    <span class="text-gray-900">No existen registros</span>
                </td>
            </tr>
        @endforelse
    </x-tabla>
</div>
