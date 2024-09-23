<section class="mb-4">
    <header class="w-full text-white bg-blue-800 text-center text-xl p-2">Datos Personales</header>
    <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
            <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-4 gap-2 mx-4">
                <div class="lg:col-span-3 w-full">
                    <x-label for="nombres" value="Nombres y Apellidos" />
                    <x-input id="nombres" name="nombres" :value="old('nombres')" class="w-full char-counter filled" type="text"
                        required autofocus autocomplete="nombres" minlength=3 />
                </div>
                <div>
                    <x-label for="ficha" value="Ficha" />
                    <x-input class="w-full filled" type="text" id="ficha" name="ficha" :value="old('ficha')" pattern="^\d{5}$"
                        required />
                </div>
            </div>
        <div class="grid lg:grid-cols-2 lg:gap-4 grid-cols-1 gap-2 mx-4 mt-2">
            <div>
                <x-label for="cedula" value="{{ __('Cédula') }}" />
                <div class="grid lg:grid-cols-7 grid-cols-4 gap-1">
                    <x-input.select name="nacionalidad" id="nacionalidad">
                        <option value="v" selected>
                            V
                        </option>
                        <option value="e">
                            E
                        </option>
                    </x-input.select>
                    <x-input id="cedula" class="lg:col-span-6 col-span-3 filled" type="text" name="cedula"
                        :value="old('cedula')" placeholder="00000000" required  pattern="^\d{3,8}$"
                        autocomplete="cedula" />
                </div>
            </div>
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input class="w-full filled" type="email" id="email" name="email" :value="old('email')"
                    autocomplete="email" required />
            </div>
        </div>
        <div class="grid lg:grid-cols-2 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2 mb-2">
            <div>
                <x-label for="telefono" value="Teléfono" />
                <x-input class="w-full filled" type="tel" id="telefono" name="telefono" :value="old('telefono')"
                    autocomplete="telefono" placeholder="04249856631" required pattern="\d{11}" />
            </div>
            <div>
                <x-label for="telefono_secundario" value="Teléfono secundario" />
                <x-input class="w-full filled" type="tel" id="telefono_secundario" name="telefono_secundario"
                    :value="old('telefono_secundario')" placeholder="04249856631" pattern="\d{11}" />
            </div>
        </div>
    </div>
</section>
