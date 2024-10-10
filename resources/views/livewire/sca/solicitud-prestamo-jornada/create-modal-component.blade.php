<div>    
    <div class="w-full flex justify-end">
        <button wire:click="formSp" class="flex gap-2 rounded-md bg-white shadow-md p-2 items-center mb-4 hover:shadow-lg hover:cursor-pointer" style="font-size: 18 !important;">
            <b class="text-blue-700">+</b><span class="text-gray-700">Agregar</span>
        </button>        
    </div>    
    @if($isOpen)
        @php
            if($postId != 0){
                $fecha = explode('-',$fs_fecha);
                $fechaActual = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
            }else{
                $fechaActual = date('Y-m-d');
            }
        @endphp
        
        <div class="modal show" tabindex="-1" role="dialog" style="display:block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-bg-dark" >
                    <div class="modal-header">
                        <h3 class="text-xl text-center w-full font-bold text-gray-900">{{ $postId ? 'Editar' : 'Crear' }} Jornada Solicitud Prestamo</h3>                        
                    </div>
                    <div class="modal-body" style="padding-top:0rem !important;padding-left: 1rem !important;padding-right: 1rem !important;">
                        <form wire:submit.prevent="store">
                            @csrf            
                            <div class="text-lg w-full text-black border-2 border-solid border-gray-300">
                                <div class="grid 2xl:grid-cols-5 md:grid-cols-2 sm:grid-cols-2 grid-cols-2 items-center gap-2 mx-2 mt-2" >
                                    <div>
                                        <x-label for="nombre" value="Fecha Inicio" />
                                        <x-input type="date"  pattern="\d{2}-\d{2}-\d{4}" placeholder="DD-MM-AAAA" wire:model.live="registroFjsp.fechaInicio" style="font-size: 12 !important;" value="" required />
                                    </div>
                                    <div>
                                        <x-label for="codigo" value="Fecha Culminación" />
                                        <x-input type="date"  pattern="\d{2}-\d{2}-\d{4}" placeholder="DD-MM-AAAA" wire:model.live="registroFjsp.fechaFin" style="font-size: 12 !important;"  required />
                                    </div>
                                </div>

                                <div class="gap-2 mx-2 mt-2">
                                    <x-label for="nombre" value="Descripción" />
                                    <x-input class="w-full" type="text" wire:model.live="registroFjsp.descripcion" required />
                                </div>

                                <div class="grid 2xl:grid-cols-5 md:grid-cols-2 sm:grid-cols-2 grid-cols-2 items-center gap-2 mx-2 mt-2" >
                                    <div>
                                        <x-label for="nombre" value="Tipo de Prestamo" />
                                        <x-input.select wire:model.live="registroFjsp.tipoPrestamo" class="w-full" required>
                                            @foreach ($tiposPrestamos as $tiposPrestamo)
                                                <option value="{{ $tiposPrestamo->id }}" >{{ $tiposPrestamo->nombre }}</option>
                                            @endforeach
                                        </x-input.select>
                                    </div>
                                    <div>
                                        <x-label for="nombre" value="Tipo de Moneda" />
                                        <x-input.select wire:model.live="registroFjsp.tipoMoneda" class="w-full" required>
                                            @foreach ($monedas as $moneda)
                                                <option value="{{ $moneda->id }}" >{{ $moneda->abreviatura }}</option>
                                            @endforeach
                                        </x-input.select>
                                    </div>
                                </div>

                                <div class="grid 2xl:grid-cols-5 md:grid-cols-2 sm:grid-cols-2 grid-cols-2 items-center gap-2 mx-2 mt-2" >
                                    <div>
                                        <x-label for="registroFjsp.montotope" value="Monto Máximo" />
                                        <x-input type="text" wire:model.live="registroFjsp.montotope" class="w-full text-end"  required />
                                    </div>
                                    <div>
                                        <x-label for="registroFjsp.cuotas" value="Cant. Cuotas" />
                                        <x-input class="w-full text-end" type="text"  wire:model.live="registroFjsp.cuotas"  required />
                                    </div>
                                </div>

                                <div class="gap-2 mx-2 mt-2">
                                    <x-label for="nombre" value="Observación" />
                                    <textarea wire:model.live="registroFjsp.observacion" class="left border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-gray-200 w-full"></textarea>
                                </div>                                
                                
                                <div class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4 gap-2 mt-4"> 
                                    <button type="button"  wire:click="closeModal" class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Cancelar</button>
                                    <button wire:click="create" class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg">{{ $postId ? 'Editar' : 'Crear' }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    @endif
</div>
