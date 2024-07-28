<section class="mb-4">
    <header class="w-full text-white bg-blue-800 text-center text-xl p-2">Datos Bancarios</header>
    <div class="text-lg w-full text-black pb-2 border-2 border-solid border-gray-300" id="bancos-section">
        @if ($edit)
            @foreach ($usuario->socio->bancos as $banco_socio)
                <div data-banco={{ $loop->iteration }} class="mb-4 pb-4 border-b border-gray-300">
                    <button type="button" class="eliminar-banco ml-3 mt-3">
                        <svg class="fill-red-500 w-3" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 320 512">
                            <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" />
                        </svg>
                    </button>
                    <div class="grid lg:grid-cols-3 lg:gap-4 gap-2 mx-4">
                        <div class="lg:col-span-2">
                            <x-label for="banco[{{ $loop->iteration }}][banco]" value="Banco" />
                            <x-input.select class="w-full select-banco"
                                name="banco[{{ $loop->iteration }}][banco]"
                                id="banco[{{ $loop->iteration }}][banco]">
                                <option value=""></option>
                                @foreach ($bancos as $banco)
                                    <option value="{{ $banco->codigo }}"
                                        @if ($banco_socio->pivot->codigo_banco == $banco->codigo) selected @endif>
                                        {{ $banco->nombre }} @if ($banco->abreviatura)
                                            ({{ $banco->abreviatura }})
                                        @endif
                                    </option>
                                @endforeach
                            </x-input.select>
                        </div>
                        <div>
                            <x-label for="banco[{{ $loop->iteration }}][tipo]" value="Tipo de cuenta" />
                            <x-input.select class="w-full" id="banco[{{ $loop->iteration }}][tipo]"
                                name="banco[{{ $loop->iteration }}][tipo]" required>
                                <option value=""></option>
                                @foreach ($tipos_cuentas as $tipo_cuenta)
                                    <option value="{{ $tipo_cuenta }}"
                                        @if ($banco_socio->pivot->tipo_cuenta == $tipo_cuenta) selected @endif>
                                        {{ $tipo_cuenta }}
                                    </option>
                                @endforeach
                            </x-input.select>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-3 lg:gap-4 gap-2 mx-4 mt-2 mb-2">
                        <div class="col-span-2 numero-cuenta-container">
                            <x-label for="banco[{{ $loop->iteration }}][numero]"
                                value="Número de cuenta" />
                            <x-input id="banco[{{ $loop->iteration }}][numero]"
                                name="banco[{{ $loop->iteration }}][numero]" class="w-full"
                                type="number" pattern="\d{20}" :value="$banco_socio->pivot->numero_cuenta" />
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <footer class="flex justify-end">
            <button type="button" id="agregar-banco"
                class="rounded-md bg-cyan-400 p-2 text-white m-2 hover:bg-cyan-800">Agregar banco</button>
        </footer>
    </div>
</section>
