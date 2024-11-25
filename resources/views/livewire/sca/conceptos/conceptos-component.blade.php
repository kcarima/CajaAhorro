<div>
    @php
        use Carbon\Carbon;
    @endphp
    <x-slot name="titulo">
        Conceptos
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
    <x-tabla titulo="Conceptos">
        <x-tabla.header :encabezados="['Codigo', 'Descripción', 'Operación', 'Estatus', 'Acciones']" />
        @forelse ($conceptos as $concepto)
            <tr>
                <td class="text-center small">{{$concepto->codigo}}</td>
                <td class="text-left small">{{$concepto->descripcion}}</td>
                <td class="text-center small">{{$concepto->accion}}</td>
                <td class="text-center small">
                    @if ($concepto->status == 1 )
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
                            <a class="dropdown-item" wire:click="editarConcepto({{$concepto->id}})" style="cursor:pointer !important;">
                                <i class="bx bx-edit-alt me-1" ></i>Editar
                            </a>
                            @if ($concepto->status == 0)
                                <a class="dropdown-item" wire:click="activarConcepto({{$concepto->id}})" style="cursor:pointer !important;"><i class="bx bx-check me-1"></i>Activar</a>
                            @else
                                <a class="dropdown-item" wire:click="desactivarConcepto({{$concepto->id}})" style="cursor:pointer !important;"><i class="bx bx-x me-1"></i>Desactivar</a>
                            @endif
                            <a class="dropdown-item" wire:click="eliminaConcepto({{$concepto->id}})" style="cursor:pointer !important;">
                                <i class="bx bx-trash me-1" ></i>Eliminar
                            </a>
                            <button class="dropdown-item del-def-btn" 
                                    wire:key="{{ $concepto->id }}"
                                    data-id="{{ $concepto->id }}" 
                                    data-module="concepto">
                                <i class='bx bx-message-alt-x'></i>
                                Eliminar
                            </button>
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
    <div class="flex justify-center mt-4 mb-4">
        {{ $conceptos->links() }}
    </div>
    @push('scripts')
        @vite(['resources/js/common/delete.js'])
    @endpush
</div>  
