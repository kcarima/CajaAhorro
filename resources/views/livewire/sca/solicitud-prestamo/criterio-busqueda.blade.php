<div class="card ">

    <h5 class="card-header"> Criterio de Búsqueda </h5>
    <div class="table-responsive text-nowrap overflow-auto">
        <table class="table table-responsive text-nowrap">
            <thead>
                <tr>
                    <td class="text-center">Fecha Solicitud</td>
                    <td class="text-center">Tipo de Prestamo</td>
                    <td class="text-center">Estatus</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <label class="text-sm font-medium cursor-pointer select-none justify-content-md-left font-size: 10 !important;" for="form.country" x-on:click="toggle" style="font-size: 10 !important;">DESDE:</label>
                        <input type="date"  pattern="\d{2}-\d{2}-\d{4}" placeholder="DD-MM-AAAA" wire:model.live="filtroBusqueda.fecha_solicitud_desde" style="font-size: 12 !important;">
                        <label class="text-sm font-medium cursor-pointer select-none "  for="form.country" x-on:click="toggle" style="font-size: 10 !important;">HASTA:</label>
                        <input type="date"  pattern="\d{2}-\d{2}-\d{4}" placeholder="DD-MM-AAAA" wire:model.live="filtroBusqueda.fecha_solicitud_hasta" style="font-size: 12 !important;">
                    </td>
                    <td class="text-center">
                        <select  wire:model.live="filtroBusqueda.tipo_prestamo" style="font-size: 12 !important;">
                            <option value="">--Todos--</option>
                            @foreach ($tiposPrestamos as $tipoPrestamo)
                                <option value="{{$tipoPrestamo->id}}">[{{$tipoPrestamo->codigo}}] - {{$tipoPrestamo->nombre}}  </option>
                            @endforeach
                        </select>

                    </td>
                    <td class="text-center">
                        <select  wire:model.live="filtroBusqueda.estatus" style="font-size: 12 !important;width: 120px !important;">
                            <option value="">--Todos--</option>
                            <option value="0">PENDIENTE</option>
                            <option value="1">APROBADO</option>
                            <option value="2">RECHAZADO</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <livewire:Sca.solicitud-prestamo.solicitud-prestamo-component :filtroBusqueda="$filtroBusqueda" />
    </div>
</div>
