<section class="mb-4">
    <header class="w-full text-white bg-blue-800 text-center text-xl p-2">Datos Beneficiarios</header>
    <div class="text-lg w-full text-black pb-2 border-2 border-solid border-gray-300"
        id="beneficiarios-section">
        @if ($edit)
            @foreach ($usuario->socio->beneficiarios as $beneficiario)
                <div data-beneficiario="{{ $loop->iteration }}"
                    class="mb-4 pb-4 border-b border-gray-300">
                    <button type="button" class="eliminar-beneficiario ml-3 mt-3">
                        <svg class="fill-red-500 w-3" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 320 512">
                            <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" />
                        </svg>
                    </button>
                    <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-4 gap-2 mx-4">
                        <div class="lg:col-span-3 w-full nombre-beneficiario-container">
                            <x-label for="beneficiario[{{ $loop->iteration }}][nombre]"
                                value="Nombres y Apellidos" />
                            <x-input id="beneficiario[{{ $loop->iteration }}][nombre]"
                                name="beneficiario[{{ $loop->iteration }}][nombre]" class="w-full"
                                type="text" :value="$beneficiario->nombre" required autofocus
                                autocomplete="nombres" minlength=3 />
                        </div>
                        <div class="nacimiento-beneficiario-container">
                            <x-label for="beneficiario[{{ $loop->iteration }}][fecha_nacimiento]"
                                value="Fecha de Nacimiento" />
                            <x-input class="w-full fecha_today"
                                id="beneficiario[{{ $loop->iteration }}][fecha_nacimiento]"
                                name="beneficiario[{{ $loop->iteration }}][fecha_nacimiento]"
                                type="date" :value="$beneficiario->fecha_nacimiento" />
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 lg:gap-4 grid-cols-1 gap-2 mx-4 mt-2">
                        <div class="cedula-beneficiario-container">
                            <x-label for="beneficiario[{{ $loop->iteration }}][nacionalidad]"
                                value="{{ __('Cédula') }}" />
                            <div class="grid lg:grid-cols-7 grid-cols-4 gap-1">
                                <x-input.select name="beneficiario[{{ $loop->iteration }}][nacionalidad]"
                                    id="beneficiario[{{ $loop->iteration }}][nacionalidad]">
                                    <option value="v"
                                        @if ($edit) @if (strtolower($beneficiario->nacionalidad) == 'v')
                                            selected @endif
                                        @endif>
                                        V
                                    </option>
                                    <option value="e"
                                        @if ($edit) @if (strtolower($beneficiario->nacionalidad) == 'e')
                                            selected @endif
                                        @endif>
                                        E
                                    </option>
                                </x-input.select>
                                <x-input id="beneficiario[{{ $loop->iteration }}][cedula]"
                                    class="lg:col-span-6 col-span-3" type="number"
                                    name="beneficiario[{{ $loop->iteration }}][cedula]"
                                    placeholder="00000000" max="99999999" required :value="$beneficiario->numero_cedula"
                                    autocomplete="cedula" />
                            </div>
                        </div>
                        <div class="email-beneficiario-container">
                            <x-label for="beneficiario[{{ $loop->iteration }}][email]"
                                value="{{ __('Email') }}" />
                            <x-input class="w-full" type="email"
                                id="beneficiario[{{ $loop->iteration }}][email]"
                                name="beneficiario[{{ $loop->iteration }}][email]" autocomplete="email"
                                :value="$beneficiario->email" required />
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2 mb-2">
                        <div class="telefono-beneficiario-container">
                            <x-label for="beneficiario[{{ $loop->iteration }}][telefono]"
                                value="Teléfono" />
                            <x-input class="w-full" type="tel"
                                id="beneficiario[{{ $loop->iteration }}][telefono]"
                                name="beneficiario[{{ $loop->iteration }}][telefono]"
                                autocomplete="telefono" placeholder="04249856631" required
                                :value="$beneficiario->telefono" pattern="\d{11}" />
                        </div>
                        <div class="telefono-secundario-beneficiario-container">
                            <x-label for="beneficiario[{{ $loop->iteration }}][telefono_secundario]"
                                value="Teléfono secundario" />
                            <x-input class="w-full" type="tel"
                                id="beneficiario[{{ $loop->iteration }}][telefono_secundario]"
                                name="beneficiario[{{ $loop->iteration }}][telefono_secundario]"
                                placeholder="04249856631" pattern="\d{11}" :value="$beneficiario->telefono_secundario" />
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <footer class="flex justify-end">
            <button type="button" id="agregar-beneficiario"
                class="rounded-md bg-cyan-400 p-2 text-white m-2 hover:bg-cyan-800">Agregar
                beneficiario</button>
        </footer>
    </div>
</section>
