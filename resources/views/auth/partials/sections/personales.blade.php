<section class="mb-4">
    <header class="w-full text-white bg-blue-800 text-center text-xl p-2">Datos Personales</header>
    <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
        @if ($user_is_admin)
            @if ($edit)
                <input type="hidden" name="user" value="{{ $usuario->uuid }}">
            @endif
            <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-4 gap-2 mx-4">
                <div class="lg:col-span-3 w-full">
                    <x-label for="nombres" value="Nombres y Apellidos" />
                    <x-input id="nombres" name="nombres" :value="$edit ? $usuario->socio->nombre : old('nombres')" class="w-full" type="text"
                        required autofocus autocomplete="nombres" minlength=3 />
                </div>
                <div>
                    <x-label for="ficha" value="Ficha" />
                    <x-input class="w-full" type="text" id="ficha" name="ficha" :value="$edit ? $usuario->socio->ficha : old('ficha')"
                        required />
                </div>
            </div>
        @endif
        <div class="grid lg:grid-cols-5 lg:gap-4 grid-cols-1 gap-2 mx-4 mt-2">
            @if ($user_is_admin)
                <div class="lg:col-span-1 w-full">
                    <x-label for="cedula" value="{{ __('Cédula') }}" />
                    <div class="grid lg:grid-cols-9 grid-cols-4 gap-1">
                        <x-input.select class="lg:col-span-3 col-span-3" name="nacionalidad" id="nacionalidad">
                            <option value="v"
                                @if ($edit) @if (strtolower($usuario->socio->nacionalidad) == 'v')
                                        selected @endif
                                @endif>
                                V
                            </option>
                            <option value="e"
                                @if ($edit) @if (strtolower($usuario->socio->nacionalidad) == 'e')
                                        selected @endif
                                @endif>
                                E
                            </option>
                        </x-input.select>
                        <x-input id="cedula" class="lg:col-span-6" type="text" name="cedula"
                            :value="$edit ? $usuario->socio->numero_cedula : old('cedula')" placeholder="00000000" required
                            autocomplete="cedula" />
                    </div>
                </div>
            @endif
            <div>
                <x-label for="fecha_nacimiento" value="Fecha de Nacimiento" />
                <x-input class="w-full" type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                    :value="$edit ? $usuario->socio->fecha_nacimiento : old('fecha_nacimiento')" />
            </div>
            <div>
                <x-label for="telefono" value="Teléfono" />
                <x-input class="w-full" type="tel" id="telefono" name="telefono" :value="$edit ? $usuario->socio->telefono : old('telefono')"
                    autocomplete="telefono" placeholder="04249856631" required pattern="\d{11}" />
            </div>
            <div>
                <x-label for="telefono_secundario" value="Teléfono secundario" />
                <x-input class="w-full" type="tel" id="telefono_secundario" name="telefono_secundario"
                    :value="$edit ? $usuario->socio->telefono_secundario : old('telefono_secundario')" placeholder="04249856631" pattern="\d{11}" />
            </div>
            @if ($edit && $user_is_admin)
                <div>
                    <x-label for="fecha_fallecido" value="Fecha Fallecido (si aplica)" />
                    <x-input class="w-full" type="date" id="fecha_fallecido" name="fecha_fallecido"
                        :value="$edit ? $usuario->socio->fecha_fallecido : old('fecha_fallecido')" />
                </div>
            @endif
        </div>
        <div class="grid lg:grid-cols-4 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2 mb-2">
            <div  class="lg:col-span-2 w-full">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input class="w-full" type="email" id="email" name="email" :value="$edit ? $usuario->email : old('email')"
                    autocomplete="email" required />
            </div>

        </div>
    </div>
</section>
