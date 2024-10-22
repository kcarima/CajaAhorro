<section class="mb-4">
    <header class="w-full text-white bg-blue-800 text-center text-xl p-2">Datos CAUNEG</header>
    <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300 mb-2">
        <div class="grid lg:grid-cols-4 grid-cols-1 lg:gap-4 gap-3 mx-4">
            <div>
                <x-label for="ingreso_cauneg" value="Fecha Ingreso" />
                <x-input class="w-full fecha_today" min="1982-03-09" id="ingreso_cauneg"
                    :value="$edit ? $usuario->socio->fecha_ingreso_cauneg : old('ingreso_cauneg')" name="ingreso_cauneg" type="date" />
            </div>
            @if ($edit)
                <div>
                    <x-label for="retiro_cauneg" value="Fecha de retiro (si aplica)" />
                    <x-input class="w-full fecha_retiro" name="retiro_cauneg" id="retiro_cauneg"
                        :value="$edit ? $usuario->socio->fecha_retiro_cauneg : old('retiro_cauneg')" type="date" />
                </div>
            @endif
            <div>
                <x-label for="rol" value="Rol" />
                <x-input.select class="w-full" id="rol" name="rol" required>
                    <option value=""></option>
                    @foreach ($roles as $rol)
                        <option value="{{ strtolower($rol->value) }}"
                            @if ($edit) @if ($usuario->tipo == $rol)
                                    selected @endif
                        @elseif (App\Classes\Enums\TipoUsuario::defaultCase() == $rol) selected @endif
                            >
                            {{ ucwords(strtolower($rol->value)) }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div>
                <x-label for="estatus" value="Estatus" />
                <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200"> {{  $usuario->status }} </p>
            </div>
        </div>
        <div class="flex items-center gap-2 mb-2 lg:mb-0 mx-4 mt-2">
            <input type="checkbox"
                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 w-5 h-5"
                id="fiador" name="fiador"
                @if ($edit) @if ($usuario->socio->es_fiador) checked @endif
                @endif
            >
            <x-label class="inline" for="fiador">Fiador</x-label>
        </div>
    </div>
</section>
