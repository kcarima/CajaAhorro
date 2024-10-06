<div class="card ">

    <h5 class="card-header"><livewire:Sca.solicitud-prestamo.create-modal-component/> Criterio de Búsqueda </h5>
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
                        <select  wire:model.live="filtroBusqueda.moneda" style="font-size: 12 !important;width: 120px !important;">
                            <option value="">--Todos--</option>
                            @foreach ($monedas as $moneda)
                                <option value="{{$moneda->id}}">{{$moneda->abreviatura}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-center">
                        <select  wire:model.live="filtroBusqueda.estatus" style="font-size: 12 !important;width: 120px !important;">
                            <option value="">--Todos--</option>
                            <option value="PENDIENTE">PENDIENTE</option>
                            <option value="APROBADO">APROBADO</option>
                            <option value="RECHAZADO">RECHAZADO</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <label class="text-sm font-medium cursor-pointer select-none justify-content-md-left " for="form.country" x-on:click="toggle" style="font-size: 13 !important;">Socio:</label>
                        <input type="text"  wire:model.live="filtroBusqueda.socio" style="font-size: 12 !important;width:50% !important;" placeholder="[# de Ficha, # de Cedula, Nombre]">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <livewire:Sca.solicitud-prestamo.solicitud-prestamo-component :filtroBusqueda="$filtroBusqueda" />
    </div>
</div>
