<section class="mb-4">
    <header class="w-full text-white bg-blue-800 text-center text-xl p-2">Datos UNEG</header>
    <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
        <div class="grid lg:grid-cols-6 grid-cols-1 lg:gap-4 gap-2 mx-4">
            <div>
                <x-label for="ingreso_uneg" value="Fecha Ingreso" />
                <x-input class="w-full" type="date" id="ingreso_uneg" name="ingreso_uneg"
                    :value="$edit ? $usuario->socio->fecha_ingreso_uneg : old('ingreso_uneg')" min="1982-03-09" required />
            </div>
            <div class="lg:col-span-2 w-full">
                <x-label for="cargo" value="Cargo" />
                <x-input list="cargos" id="cargo" name="cargo" class="w-full" type="text"
                    value="{{ $edit ? $usuario->socio->cargo?->nombre : '' }}" required />
                <datalist id="cargos">
                    @foreach ($cargos as $cargo)
                        <option value="{{ $cargo }}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class="lg:col-span-3 w-full">
                <x-label for="departamento" value="Departamento" />
                <x-input list="departamentos" name="departamento" id="departamento" class="w-full"
                    value="{{ $edit ? $usuario->socio->departamento?->nombre : '' }}" type="text"
                    required />
                <datalist id="departamentos">
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento }}"></option>
                    @endforeach
                </datalist>
            </div>
        </div>
        <div class="grid lg:grid-cols-4 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2">
            <div>
                <x-label for="tipo" value="Tipo de empleado" />
                <x-input.select class="w-full" id="tipo" name="tipo" required>
                    <option value=""></option>
                    @foreach ($tipos_empleados as $tipo_empleado)
                        <option value="{{ $tipo_empleado->id }}"
                            @if ($edit) @if ($usuario->socio->tipo_trabajador?->id == $tipo_empleado->id)
                                    selected @endif
                            @endif
                            >{{ $tipo_empleado->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div>
                <x-label for="relacion_laboral" value="Condición" />
                <x-input.select class="w-full" id="relacion_laboral" name="relacion_laboral" required>
                    @foreach ($condiciones_laborales as $condicion_laboral)
                        <option value="{{ $condicion_laboral->id }}"
                            @if ($edit) @if ($usuario->socio->relacion_laboral?->id == $condicion_laboral->id)
                                    selected @endif
                            @endif
                            >{{ $condicion_laboral->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div>
                <x-label for="sede" value="Sede" />
                <x-input.select class="w-full filled" id="sede" name="sede" >
                    @foreach ($sedes as $sede)
                    <option value="{{ $sede->id }}"
                        @if ($edit) @if ($usuario->socio->sede?->id == $sede->id)
                                selected @endif
                        @endif
                        >{{ $sede->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div>
                <x-label for="sueldo" value="Sueldo" />
                <x-input class="w-full" id="sueldo" min="0" name="sueldo" type="number"
                    :value="$edit ? number_format($usuario->socio->sueldo, 2, '.', ',') : old('sueldo')" step="0.1" required />
            </div>
        </div>

        <div class="grid lg:grid-cols-6 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2">
            <div class="lg:col-span-2 w-full">
                <x-label for="zona" value="Zona" />
                <x-input.select class="w-full filled" id="zona" name="zona">
                    @foreach ($zonas as $zona)
                        <option value="{{ $zona->id }}"
                            @if ($edit) @if ($usuario->socio->zona?->id == $zona->id)
                                selected @endif
                            @endif
                            >{{ $zona->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>
            @if ($edit)
                <div>
                    <x-label for="retiro_uneg" value="Fecha de retiro (si aplica)" />
                    <x-input class="w-full fecha_today" id="retiro_uneg" type="date" :value="$edit ? $usuario->socio->fecha_retiro_uneg : old('retiro_uneg')"
                        name="retiro_uneg" />
                </div>
            @endif
        </div>
    </div>
</section>
