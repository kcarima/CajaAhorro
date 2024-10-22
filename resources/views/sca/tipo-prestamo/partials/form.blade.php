<div>
    <header class="mb-4">
        <h1 class="text-center text-3xl">{{ $titulo }}</h1>
    </header>

    <x-validation-errors />

    @php
        $meses_tasa = old('meses_tasa') ?? 12;
        $plazo = old('plazo') ?? 0;
        $dias_cuotas = old('dias_cuotas') ?? 30;
        $nombre = old('nombre');
        $codigo = old('codigo');
        $cuotas = old('cuotas');
        $interes = old('interes');
        $cuota_especial = old('especial') != '' ? true : false;
        $habilitado = old('habilitado') ?? true;

        if(isset($tipo)) {

            if(!old('nombre')) {
                $nombre = $tipo->nombre;
            }

            if(!old('codigo')) {
                $codigo = $tipo->codigo;
            }

            if(!old('cuotas')) {
                $cuotas = $tipo->cantidad_cuotas;
            }

            if(!old('dias_cuotas')) {
                $dias_cuotas = $tipo->dias_cuotas;
            }

            if(!old('interes')) {
                $interes = $tipo->tasa_interes;
            }

            if(!old('meses_tasa')) {
                $meses_tasa = $tipo->meses_tasa;
            }

            if(!old('plazo')) {
                $plazo = $tipo->plazo_siguiente_solicitud;
            }

            if(!old('cuota_especial')) {
                $cuota_especial = $tipo->cuota_especial;
            }

            if(!old('habilitado')) {
                $habilitado = $tipo->habilitar;
            }
        }

    @endphp

    <form action="{{ $action }}" method="POST">
        @csrf

        @isset($tipo)
            @method('patch')
            <input type="hidden" name="tipo" value="{{ $tipo->uuid }}" >
        @endisset

        <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
            <div class="grid 2xl:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 items-center gap-4 mx-4 mt-4">
                <div>
                    <x-label for="nombre" value="{{ __('Nombre') }}" />
                    <x-input class="w-full" type="text" id="nombre" name="nombre" value="{{ $nombre }}" required />
                </div>
                <div>
                    <x-label for="codigo" value="{{ __('Código') }}" />
                    <x-input class="w-full" type="text" id="codigo" name="codigo" value="{{ $codigo }}" required />
                </div>
                <div>
                    <x-label for="cuotas" value="{{ __('Cantidad Cuotas') }}" />
                    <x-input class="w-full" type="number" id="cuotas" name="cuotas" value="{{ $cuotas }}" required />
                </div>
                <div>
                    <x-label for="dias_cuotas" value="{{ __('Dias Cuotas') }}" />
                    <x-input class="w-full" type="number" id="dias_cuotas" value="{{ $dias_cuotas }}" name="dias_cuotas" />
                </div>
                <div>
                    <x-label for="interes" value="{{ __('Tasa Interes') }}" />
                    <x-input class="w-full" type="number" id="interes" name="interes" value="{{ $interes }}" required />
                </div>
                <div>
                    <x-label for="meses_tasa" value="{{ __('Meses Tasa') }}" />
                    <x-input class="w-full" type="number" id="meses_tasa" name="meses_tasa"  value="{{ $meses_tasa }}" />
                </div>
                <div>
                    <x-label for="plazo" value="{{ __('Plazo Siguiente Solicitud') }}" />
                    <x-input class="w-full" type="number" id="plazo" name="plazo" value="{{ $plazo }}" />
                </div>
                <div>
                    <input type="checkbox"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 w-5 h-5"
                        id="especial" name="especial" @checked($cuota_especial)>
                    <x-label class="inline" for="especial">Cuota Especial</x-label>
                </div>
                <div>
                    <input type="checkbox"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 w-5 h-5"
                        id="habilitado" name="habilitado" @checked($habilitado)>
                    <x-label class="inline" for="habilitado">Habilitado</x-label>
                </div>
            </div>

            <footer class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4 gap-2 mt-4">
                <button type="button" onclick="history.back();"
                    class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Cancelar</button>
                <button type="submit"
                    class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg">Enviar</button>
            </footer>
        </div>

    </form>

</div>
