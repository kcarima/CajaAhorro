<div>
    <div class="w-full flex justify-end">
        <button wire:click="openModal" class="flex gap-2 rounded-md bg-white shadow-md p-2 items-center mb-4 hover:shadow-lg hover:cursor-pointer" style="font-size: 18 !important;">
            <b class="text-blue-700">+</b><span class="text-gray-700">Agregar</span>
        </button>
    </div>
    @if($isOpen)
        <div class="modal show" tabindex="-1" role="dialog" style="display:block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-bg-dark" >
                    <div class="modal-header">
                        <h3 class="text-xl text-center w-full font-bold text-gray-900">{{ $archivo_id ? 'Editar' : 'Crear' }} Conceptos</h3>
                    </div>
                    <div class="modal-body" style="padding-top:0rem !important;padding-left: 1rem !important;padding-right: 1rem !important;">
                        <form wire:submit.prevent="store">
                            @csrf
                            <div class="text-lg w-full text-black border-2 border-solid border-gray-300">
                                <div class="grid 2xl:grid-cols-5 md:grid-cols-2 sm:grid-cols-2 grid-cols-2 items-center gap-2 mx-2 mt-2" >
                                    <div>
                                        <x-label for="fecha" value="Fecha:" />
                                        <x-input class="w-full" type="text" wire:model.live="fecha" required id="fecha" name="fecha"/>
                                        @error('codigo')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <x-label for="descripcion" value="Descripcion:" />
                                        <x-input class="w-full" type="text" wire:model.live="descripcion" required id="descripcion" name="descripcion"/>
                                        @error('descripcion')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>                                    
                                </div>

                                <br>
                                <hr class="my-4  items-center " style="border: 1px solid #ccc;">                                
                                <div class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4 gap-2 mt-4">
                                    <button type="button"  wire:click="closeModal" class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Cancelar</button>
                                    <button type="submit"  id="myButton"  class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg">{{ $archivo_id ? 'Editar' : 'Crear' }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
