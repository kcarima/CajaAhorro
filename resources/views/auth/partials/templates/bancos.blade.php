<template id="bancos-container">
    <div class="mb-4 pb-4 border-b border-gray-300">
        <button type="button" class="eliminar-banco ml-3 mt-3">
            <svg class="fill-red-500 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" />
            </svg>
        </button>
        <div class="grid lg:grid-cols-3 lg:gap-4 gap-2 mx-4 pt-2">
            <div class="lg:col-span-2 banco-container">
                <x-label for="" value="Banco" />
                <x-input.select class="w-full select-banco filled" name="" id="" required>
                    <option value=""></option>
                    @foreach ($bancos as $banco)
                        <option value="{{ $banco->codigo }}">{{ $banco->nombre }} @if ($banco->abreviatura)
                                ({{ $banco->abreviatura }})
                            @endif
                        </option>
                    @endforeach
                </x-input.select>
            </div>
            <div class="tipo-cuenta-container">
                <x-label for="" value="Tipo de cuenta" />
                <x-input.select class="w-full filled" id="" name="" required>
                    <option value=""></option>
                    @foreach ($tipos_cuentas as $tipo_cuenta)
                        <option value="{{ $tipo_cuenta }}">{{ $tipo_cuenta }}</option>
                    @endforeach
                </x-input.select>
            </div>
        </div>
        <div class="grid lg:grid-cols-3 lg:gap-4 gap-2 mx-4 mt-2 mb-2">
            <div class="col-span-2 numero-cuenta-container">
                <x-label for="" value="Número de cuenta" />
                <x-input id="" name="" class="w-full filled" type="number" pattern="^\d{20}$" required />
            </div>
        </div>
    </div>
</template>
