<div>
    <header class="mb-4">
        <h1 class="text-center text-3xl">{{ $titulo }}</h1>
    </header>

    <x-validation-errors />

    @php
        $selected_moneda1 = old('moneda1');
        $selected_moneda2 = old('moneda2');
        $cantidad = old('cantidad');

        if(isset($conversion)) {

            if(!old('moneda1')) {
                $selected_moneda1 = $conversion->monedaPrincipal->uuid;
            }

            if(!old('moneda2')) {
                $selected_moneda2 = $conversion->monedaSecundaria->uuid;
            }

            if(!old('cantidad')) {
                $cantidad = $conversion->cantidad_moneda_secundaria;
            }

        }

    @endphp

    <form action="{{ $action }}" method="POST">
        @csrf

        @isset($conversion)
            @method('patch')
        @endisset

        <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mx-4 mt-4">
                <div>
                    <x-label for="moneda1" value="{{ __('Moneda Principal') }}" />
                    <x-input.select name="moneda1" id="moneda1" class="w-full">
                        @foreach ($monedas as $moneda)
                            <option value="{{ $moneda->uuid }}" @selected( $selected_moneda1 !== '' ? $selected_moneda1 == $moneda->uuid : $moneda->es_default)>{{ $moneda->nombre }} ({{ $moneda->abreviatura }}) </option>
                        @endforeach
                    </x-input.select>
                </div>
                <div>
                    <x-label for="moneda2" value="{{ __('Moneda Secundaria') }}" />
                    <x-input.select name="moneda2" id="moneda2" class="w-full">
                        <option value=""></option>
                        @foreach ($monedas as $moneda)
                            <option value="{{ $moneda->uuid }}" @selected( $selected_moneda2 == $moneda->uuid)>{{ $moneda->nombre }} ({{ $moneda->abreviatura }}) </option>
                        @endforeach
                    </x-input.select>
                </div>
            </div>
            <div class="mx-4 mt-4">
                <x-label for="cantidad" value="{{ __('Cantidad de la moneda secundaria equivalentes a una unidad de la moneda principal') }}" />
                <x-input type="number" id="cantidad" name="cantidad" min="0" step="0.01" value="{{ $cantidad }}" required />
            </div>

            <footer class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4 gap-2 mt-4">
                <button type="button" onclick="history.back();"
                    class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Cancelar</button>
                <button type="submit" class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg">Enviar</button>
            </footer>
        </div>

    </form>

</div>
