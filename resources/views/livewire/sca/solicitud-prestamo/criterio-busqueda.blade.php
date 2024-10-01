<div class="card ">
    <!--tipoPrestamo-->    
    <h5 class="card-header">Criterio de Búsqueda</h5>
    <div class="table-responsive text-nowrap overflow-auto">
        <table class="table table-responsive text-nowrap">
            <thead>
                <tr>
                    <td class="text-center">Fecha Solicitud</td>
                    <td class="text-center">Tipo de Prestamo</td>
                    <td class="text-center">Moneda</td>
                    <td class="text-center">Estatus</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <input type="date"  pattern="\d{2}-\d{2}-\d{4}" placeholder="DD-MM-AAAA" wire:model="busqueda.fecha_solicitud" wire:change="updateBus" style="font-size: 12 !important;"> 
                    </td>
                    <td class="text-center">                        
                        <select  wire:model="busqueda.tipo_prestamo" style="font-size: 12 !important;"> 
                            <option value="">--Todos--</option>
                            @foreach ($tiposPrestamos as $tipoPrestamo)
                                <option value="{{$tipoPrestamo->id}}">[{{$tipoPrestamo->codigo}}] - {{$tipoPrestamo->nombre}}  </option>
                            @endforeach
                        </select> 
                        
                    </td>
                    <td class="text-center">
                        <select  wire:model="busqueda.moneda" style="font-size: 12 !important;width: 120px !important;"> 
                            <option value="">--Todos--</option>
                            <option value="1">BS</option>
                            <option value="1">USD</option>
                            <option value="2">EUR</option>
                        </select> 
                    </td>
                    <td class="text-center">
                        <select  wire:model="busqueda.estatus" style="font-size: 12 !important;width: 120px !important;"> 
                            <option value="">--Todos--</option>
                            <option value="0">Pendiente</option>
                            <option value="1">Aprobados</option>
                            <option value="2">Rechazados</option>
                        </select>            
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
