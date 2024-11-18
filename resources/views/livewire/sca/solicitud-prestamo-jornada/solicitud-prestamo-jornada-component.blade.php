<div>
    @php
        use Carbon\Carbon;
    @endphp
    <x-slot name="titulo">
        Jornadas Solicitud Prestamo
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

    <x-tabla titulo="Jornadas Solicitud Prestamo">
        <x-tabla.header :encabezados="['Inicio - Cierre','Descripción', 'Solicitudes','Aprobadas','Rechazadas','Estatus', 'Acciones']" />
        @forelse ($jornadas as $jornada)
        <tr class="hover-row" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
            <td class="text-center small">
                [{{ Carbon::parse($jornada->fecha_inicio)->format('d/m/Y') }}] - [{{ Carbon::parse($jornada->fecha_cierre)->format('d/m/Y') }}]
            </td>
            <td class="text-left small">
                {{ $jornada->nombre }}
            </td>
            <td class="text-center small">
                0
            </td>
            <td class="text-center small" >
                0
            </td>
            <td class="text-center small">
                0
            </td>
            <td class="text-center small">
                @if ($jornada->status == 1 )
                    <button type="button" class="btn btn-sm btn-success">Activa</button>
                @else
                    <button type="button" class="btn btn-sm btn-danger">Inactiva</button>                    
                @endif
            </td>
            <td class="text-center small">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" style="cursor:pointer !important;"><i class="bx bx-search-alt me-1"></i>Detalle</a>
                        @if ($jornada->status == 0)
                            <a class="dropdown-item" wire:click="activarJSp({{$jornada->id}})" style="cursor:pointer !important;"><i class="bx bx-check me-1"></i>Activar</a>
                        @else
                            <a class="dropdown-item" wire:click="desactivarJSp({{$jornada->id}})" style="cursor:pointer !important;"><i class="bx bx-x me-1"></i>Desactivar</a>
                        @endif
                        <a class="dropdown-item" wire:click="editarJSp({{$jornada->id}})" style="cursor:pointer !important;"><i
                            class="bx bx-edit-alt me-1" ></i>
                        Editar</a>
                        <a class="dropdown-item" wire:click="eliminarJSp({{$jornada->id}})" style="cursor:pointer !important;"><i
                            class="bx bx-trash me-1" ></i>
                        Eliminar</a>
                    </div>
                </div>
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center" >
                    <span class="text-gray-900">No existen registros</span>
                </td>
            </tr>
        @endforelse
    </x-tabla>
    <script>
        function cambiar_color_over(celda){ 
            celda.className="sombra_tilde";		
        } 
        function cambiar_color_out(celda){
            celda.className="";		
        } 
    </script>
    <style>
        .sombra_tilde {
            background-color: #f0f0f0;
        }
    </style>
</div>
