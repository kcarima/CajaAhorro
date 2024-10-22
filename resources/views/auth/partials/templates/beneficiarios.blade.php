<template id="beneficiario-container">
    <div class="mb-4 pb-4 border-b border-gray-300">
        <button type="button" class="eliminar-beneficiario ml-3 mt-3">
            <svg class="fill-red-500 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" />
            </svg>
        </button>
        <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-4 gap-2 mx-4">
            <div class="lg:col-span-3 w-full nombre-beneficiario-container">
                <x-label for="nombres" value="Nombres y Apellidos" />
                <x-input id="" name="" class="w-full filled" type="text" required minlength=3 />
            </div>
            <div class="nacimiento-beneficiario-container">
                <x-label for="" value="Fecha de Nacimiento" />
                <x-input class="w-full fecha_today filled" id="" name="" type="date" required />
            </div>
        </div>
        <div class="grid lg:grid-cols-2 lg:gap-4 grid-cols-1 gap-2 mx-4 mt-2">
            <div class="cedula-beneficiario-container">
                <x-label for="cedula" value="{{ __('Cédula') }}" />
                <div class="grid lg:grid-cols-7 grid-cols-4 gap-1">
                    <x-input.select name="" id="">
                        <option value="v" selected>
                            V
                        </option>
                        <option value="e">
                            E
                        </option>
                    </x-input.select>
                    <x-input id="" class="lg:col-span-6 col-span-3 filled" type="number" name=""
                        placeholder="00000000" max="99999999" required />
                </div>
            </div>
            <div class="email-beneficiario-container">
                <x-label for="" value="{{ __('Email') }}" />
                <x-input class="w-full filled" type="email" id="" name="" required />
            </div>
        </div>
        <div class="grid lg:grid-cols-2 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2 mb-2">
            <div class="telefono-beneficiario-container">
                <x-label for="" value="Teléfono" />
                <x-input class="w-full filled" type="tel" id="" name="" autocomplete="telefono"
                    placeholder="04249856631" required pattern="\d{11}" />
            </div>
            <div class="telefono-secundario-beneficiario-container">
                <x-label for="" value="Teléfono Secundario" />
                <x-input class="w-full filled" type="tel" id="" name="" placeholder="04249856631"
                    pattern="\d{11}" />
            </div>
        </div>
        <div class="grid lg:grid-cols-5 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2 mb-2">
            <div class="parentesco-beneficiario-container col-span-2">
                <x-label for="" value="{{ __('Parentesco') }}" />
                <x-input.select name="" id="" class="filled" required>
                    <option value=""></option>
                    @foreach ($parentescos as $parentesco)
                        <option value="{{ $parentesco->uuid }}">{{ $parentesco->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div class="porcentaje-beneficiario-container">
                <x-label for="" value="{{ __('% de Adjudicación') }}" />
                <x-input id="" class="filled porcentaje-beneficiarios" type="number" name=""
                    min="1" max="100" required />
            </div>
            <div class="documento-cedula-beneficiario-container col-span-2">
                <x-label for="doc_cedula" value="Copia de la Cédula de Identidad o Partida de Nacimiento" />
                <input id="doc_cedula" class="filled" name="doc_cedula" type="file" data-max-size="100" accept="image/*,.pdf" required>
            </div>
        </div>
    </div>
</template>
