<div>
    <button wire:click="formSp" class="btn btn-primary float-right" style="font-size: 18 !important;">+</button>
    @if($isOpen)
        @php
            if($postId != 0){
                $fecha = explode('-',$fs_fecha);
                $fechaActual = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
            }else{
                $fechaActual = date('d-m-Y');
            }
        @endphp
        <div class="modal show" tabindex="-1" role="dialog" style="display:block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-bg-dark" >
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $postId ? 'Editar' : 'Crear' }} Solicitud Prestamo</h5>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="store">
                            <div class="form-group">
                                <label for="fs_create" class="strong">Fecha Solicitud:</label><h5 class="btn">{{$fechaActual}}</h5>
                            </div>
                            <div class="form-group">
                                <label for="body">Tipo de Prestamo:</label>
                                <select  wire:model.live="fs_tipo_prestamo" style="font-size: 12 !important;width: 50% !important;">
                                    @foreach ($tiposPrestamos as $tipoPrestamo)
                                        <option value="{{$tipoPrestamo->id}}" {{ $postId ? $fs_tipo_prestamo == $tipoPrestamo->id ? 'selected' : '' : '' }}>[{{$tipoPrestamo->codigo}}] - {{$tipoPrestamo->nombre}}  </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="body">Moneda:</label>
                                <select  wire:model.live="fs_moneda" style="font-size: 12 !important;width: 80px !important;">
                                    @foreach ($monedas as $moneda)
                                        <option value="{{$moneda->id}}" {{ $postId ? $fs_moneda == $moneda->id ? 'selected' : '' : '' }}>{{$moneda->abreviatura}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">
                                {{ $postId ? 'Editar' : 'Crear' }}
                            </button>
                            <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
