<div>    
    @php
        use Carbon\Carbon;        
    @endphp

    @if ($count > 0)
        <div class="w-full flex justify-end">
            <button wire:click="formSp" class="flex gap-2 rounded-md bg-white shadow-md p-2 items-center mb-4 hover:shadow-lg hover:cursor-pointer" style="font-size: 18 !important;">
                <b class="text-blue-700">+</b><span class="text-gray-700">Agregar</span>
            </button>
        </div>    
    @endif
    @if($isOpen)        
        <div class="modal show" tabindex="-1" role="dialog" style="display:block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-bg-dark" >
                    <div class="modal-header">
                        <h3 class="text-xl text-center w-full font-bold text-gray-900">{{ $postId ? 'Editar' : 'Crear' }} Solicitud Prestamo </h3>
                    </div>
                    <div class="modal-body" style="padding-top:0rem !important;padding-left: 1rem !important;padding-right: 1rem !important;">
                        <form wire:submit.prevent="store">
                            @csrf
                            @if($postId == 0)

                                <input type="hidden"  wire:model.live="fs_fecha_solicitud" id="fecha_solicitud" name="fecha_solicitud" value="{{Carbon::now()->format('Y-m-d')}}"/>
                                <input type="hidden"  wire:model.live="fs_jornada_detalle_id" id="jornada_detalle_id" name="fs_jornada_detalle_id" value="{{$jornada[0]->jornadaDetalle[0]->id}}"/>
                                <input type="hidden"  wire:model.live="fs_tipo_prestamo" id="tipo_prestamo" name="fs_tipo_prestamo" value="{{$jornada[0]->jornadaDetalle[0]->TipoPrestamo->id}}"/>
                                <input type="hidden"  wire:model.live="fs_moneda_id" id="moneda_id" name="fs_moneda_id" value="{{$jornada[0]->jornadaDetalle[0]->Moneda->id}}"/>
                                <input type="hidden"  wire:model.live="fs_cant_cuotas" id="cant_cuotas" name="cant_cuotas" value="{{$jornada[0]->jornadaDetalle[0]->cant_cuotas}}"/>                                
                            @endif
                            <div class="text-lg w-full text-black border-2 border-solid border-gray-300">
                                <div class="grid 2xl:grid-cols-5 md:grid-cols-2 sm:grid-cols-2 grid-cols-2 items-center gap-2 mx-2 mt-2" >
                                    <div>
                                        <x-label for="fecha_solicitud" value="Fecha Solicitud:" />
                                        @if ($postId == 0)
                                            {{ Carbon::now()->format('d/m/Y') }}
                                        @else
                                            {{ Carbon::parse($fs_fecha_solicitud)->format('d/m/Y') }}                                            
                                        @endif
                                    </div>
                                    <div>
                                        <x-label for="jornada" value="Jornada:" />                                        
                                        {{$fs_jornada_nombre}}
                                    </div>
                                </div>

                                <div class="grid 2xl:grid-cols-5 md:grid-cols-2 sm:grid-cols-2 grid-cols-2 items-center gap-2 mx-2 mt-2" >
                                    <div>
                                        <x-label for="tipo_prestamo" value="Tipo Prestamo:" />
                                        {{$fs_tp_nombre}}
                                    </div>
                                    <div>
                                        <x-label for="moneda" value="Moneda:" />
                                        {{$fs_moneda_nombre}}
                                    </div>
                                </div>

                                <div class="grid 2xl:grid-cols-5 md:grid-cols-2 sm:grid-cols-2 grid-cols-2 items-center gap-2 mx-2 mt-2" >
                                    <div>
                                        <x-label for="cuotas" value="Cant. Cuotas:" />
                                        {{number_format($fs_cant_cuotas, 0)}}
                                    </div>
                                    <div>
                                        <x-label for="monto_maximo" value="Monto Maximo:" />
                                        {{number_format($fs_monto_tope, 2, ',', '.')}}
                                    </div>
                                </div>

                                <div class="grid 2xl:grid-cols-5 md:grid-cols-2 sm:grid-cols-2 grid-cols-2 items-center gap-2 mx-2 mt-2" >
                                    <div>
                                        <x-label for="monto_solicitud" value="Monto Solicitar:" />
                                        <x-input type="number" wire:model="fs_monto"  class="w-full text-end" required id="monto_solicitud" name="monto_solicitud" />
                                        @error('monto_solicitud')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>                                                                        
                                </div>
                                <br>
                                <hr class="my-4  items-center " style="border: 1px solid #ccc;">                                
                                <div class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4 gap-2 mt-4">
                                    <button type="button"  wire:click="closeModal" class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Cancelar</button>
                                    <button type="submit"  id="myButton"  class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg">{{ $postId ? 'Editar' : 'Crear' }}</button>
                                </div>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
