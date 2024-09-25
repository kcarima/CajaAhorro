<section class="mb-4">
    <header class="w-full text-white bg-blue-800 text-center text-xl p-2">Datos UNEG</header>
    <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
        <div class="grid lg:grid-cols-3 grid-cols-1 lg:gap-4 gap-2 mx-4">
            <div>
                <x-label for="ingreso_uneg" value="Fecha Ingreso" />
                <x-input class="w-full filled" type="date" id="ingreso_uneg" name="ingreso_uneg"
                    :value="old('ingreso_uneg')" min="1982-03-09" required />
            </div>
            <div>
                <x-label for="cargo" value="Cargo" />
                <x-input list="cargos" id="cargo" name="cargo" class="w-full filled" type="text"
                    :value="old('cargos')" required />
                <datalist id="cargos">
                    @foreach ($cargos as $cargo)
                        <option value="{{ $cargo }}"></option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <x-label for="departamento" value="Departamento" />
                <x-input list="departamentos" name="departamento" id="departamento" class="w-full filled"
                    :value="old('departamento')" type="text" required />
                <datalist id="departamentos">
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento }}"></option>
                    @endforeach
                </datalist>
            </div>
        </div>
        <div class="grid lg:grid-cols-3 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2">
            <div>
                <x-label for="tipo" value="Tipo de empleado" />
                <x-input.select class="w-full filled" id="tipo" name="tipo" required>
                    <option value=""></option>
                    @foreach ($tipos_empleados as $tipo_empleado)
                        <option value="{{ $tipo_empleado->uuid }}">{{ $tipo_empleado->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div>
                <x-label for="relacion_laboral" value="Condición" />
                <x-input.select class="w-full filled" id="relacion_laboral" name="relacion_laboral" required>
                    <option value=""></option>
                    @foreach ($condiciones_laborales as $condicion_laboral)
                        <option value="{{ $condicion_laboral->uuid }}">{{ $condicion_laboral->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div>
                <x-label for="sueldo" value="Sueldo" />
                <x-input class="w-full filled" id="sueldo" min="0" name="sueldo" type="number"
                    :value="old('sueldo')" step="0.1" required />
            </div>
        </div>
        <div class="grid lg:grid-cols-3 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2">
            <div>
                <x-label for="sede" value="Sede" />
                <x-input.select class="w-full filled" id="sede" name="sede">
                    <option value=""></option>
                    @foreach ($sedes as $sede)
                        <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div>
                <x-label for="zona" value="Zona" />
                <x-input.select class="w-full filled" id="zona" name="zona">
                    <option value=""></option>
                    @foreach ($zonas as $zona)
                        <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>
        </div>
    </div>
</section>
