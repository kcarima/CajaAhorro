<div>
    <i class="bx bx-search fs-4 lh-0"></i>
    <label class="text-sm font-medium cursor-pointer select-none "  for="filtroBusqueda.descripcion" x-on:click="toggle" style="font-size: 10 !important;">Descripción:</label>
    <input type="text" placeholder="descripcion" wire:model.live="filtroBusqueda.descripcion" style="font-size: 12 !important;" id="filtroBusqueda.descripcion" name="filtroBusqueda.descripcion" wire:model.debounce.500ms="buscaconceptos();">
    <label class="text-sm font-medium cursor-pointer select-none "  for="filtroBusqueda.descripcion" x-on:click="toggle" style="font-size: 10 !important;">Estatus:</label>
    <select  wire:model.live="filtroBusqueda.estatus" style="font-size: 12 !important;width: 120px !important;" id="filtroBusqueda.estatus" name="filtroBusqueda.estatus" wire:model.debounce.500ms="buscaconceptos();">
        <option value="">--Todos--</option>
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select>
</div>
