<div>
    <header class="mb-4">
        <h1 class="text-center text-3xl">{{ $titulo }}</h1>
    </header>

    <x-validation-errors />

    @php
        $selected_banco = old('banco');
        $numero = old('numero');
        $selected_tipo = old('tipo_cuenta');
        $saldo = old('saldo');
        $selected_moneda = old('moneda');
        $chck_public = old('public');
        $agencia = old('agencia');

        if(isset($cuenta)) {

            if(!old('banco')) {
                $selected_banco = $cuenta->banco->codigo;
            }

            if(!old('numero')) {
                $numero = $cuenta->numero;
            }

            if(!old('tipo_cuenta')) {
                $selected_tipo = $cuenta->tipoCuentaBancaria->uuid;
            }

            if(!old('saldo')) {
                $saldo = $cuenta->saldo;
            }

            if(!old('moneda')) {
                $selected_moneda = $cuenta->moneda->uuid;
            }

            if(!old('public')) {
                $chck_public = $cuenta->is_public;
            }

            if(!old('agencia')) {
                $agencia = $cuenta->agencia;
            }
        }

    @endphp

    <form action="{{ $action }}" method="POST">
        @csrf

        @isset($cuenta)
            @method('patch')
            <input type="hidden" name="cuenta" value="{{ $cuenta->uuid }}" >
        @endisset

        <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mx-4 mt-4">
                <div>
                    <x-label for="banco" value="{{ __('Banco') }}" />
                    <x-input.select name="banco" id="banco" class="w-full" required>
                        <option value=""></option>
                        @foreach ($bancos as $banco)
                            <option value="{{ $banco->codigo }}" @selected($selected_banco == $banco->codigo)>{{ $banco->nombre }} @if($banco->abreviatura) ({{ $banco->abreviatura }})  @endif</option>
                        @endforeach
                    </x-input.select>
                </div>
                <div>
                    <x-label for="numero" value="{{ __('Número de Cuenta') }}" />
                    <x-input class="w-full" type="text" id="numero" minlenght="20" maxlenght="20" pattern="\d{20}" name="numero" value="{{ $numero }}" required />
                </div>
            </div>
            <div class="grid md:grid-cols-4 grid-cols-2 gap-4 mx-4 mt-4">
                <div>
                    <x-label for="tipo-cuenta" value="{{ __('Tipo de Cuenta') }}" />
                    <x-input.select name="tipo_cuenta" id="tipo-cuenta" class="w-full" required>
                        <option value=""></option>
                        @foreach ($tiposCuentasBancarias as $tipo)
                            <option value="{{ $tipo->uuid }}" @selected($selected_tipo == $tipo->uuid)>{{ $tipo->nombre }} </option>
                        @endforeach
                    </x-input.select>
                </div>
                <div>
                    <x-label for="saldo" value="{{ __('Saldo') }}" />
                    <x-input class="w-full" type="number" step="0.01" id="saldo" min="0" name="saldo" value="{{ $saldo }}" />
                </div>
                <div>
                    <x-label for="moneda" value="{{ __('Moneda') }}" />
                    <x-input.select name="moneda" id="moneda" class="w-full">
                        @foreach ($monedas as $moneda)
                            <option value="{{ $moneda->uuid }}" @selected( $selected_moneda !== '' ? $selected_moneda == $moneda->uuid : $moneda->es_default)>{{ $moneda->nombre }} ({{ $moneda->abreviatura }}) </option>
                        @endforeach
                    </x-input.select>
                </div>
                <div class="self-center">
                    <input type="checkbox"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 w-5 h-5"
                        id="public" name="public"
                        @checked($chck_public)
                    >
                    <x-label class="inline" for="public">Cuenta Pública</x-label>
                </div>
            </div>
            <div class="mx-4 mt-4">
                <x-label for="agencia" value="{{ __('Agencia') }}" />
                <x-input class="w-full" type="text" id="agencia" name="agencia" value="{{ $agencia }}" required />
            </div>

            <footer class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4 gap-2 mt-4">
                <button type="button" onclick="history.back();"
                    class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Cancelar</button>
                <button type="submit" class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg">Enviar</button>
            </footer>
        </div>

    </form>

</div>
