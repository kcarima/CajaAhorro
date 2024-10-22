<x-app-layout titulo="{{ $usuario->socio->nombre }}">

    <header class="mb-4">
        <h1 class="text-center text-3xl">Datos del Usuario</h1>
    </header>
        <summary @if ($usuario->intentos_login == 3) class="w-full text-white bg-red-700 text-xl p-2" @else class="w-full text-white bg-blue-700 text-xl p-2" @endif
 //       <summary class="w-full text-white bg-blue-800 text-xl p-2">Datos Personales</summary>
        <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
            <div class="grid grid-cols-1 lg:grid-cols-10 lg:gap-4 gap-2 mx-4">
                <div class="lg:col-span-5 w-full">
                    <p class="block font-medium text-sm text-gray-700">Nombres y Apellidos</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">{{ $usuario->socio->nombre }}
                    </p>
                </div>
                <div class="lg:col-span-2 w-full">
                    <p class="block font-medium text-sm text-gray-700">Cédula</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">{{ $usuario->cedula }}</p>
                </div>
                <div class="lg:col-span-2 w-full">
                    <p class="block font-medium text-sm text-gray-700">Fecha Nacimiento</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ standart_date_format($usuario->socio->fecha_nacimiento ?? '2000-01-01') }}</p>
                </div>
                <div>
                    <p class="block font-medium text-sm text-gray-700">Ficha</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">{{ $usuario->socio->ficha }}
                    </p>
                </div>
            </div>
            <div class="grid lg:grid-cols-5 lg:gap-4 grid-cols-1 gap-2 mx-4 mt-2">
                <div>
                    <p class="block font-medium text-sm text-gray-700">Teléfono</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ $usuario->socio->telefono ?? 'N/D' }}</p>
                </div>
                <div>
                    <p class="block font-medium text-sm text-gray-700">Teléfono secundario</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ $usuario->socio->telefono_secundario ?? 'N/D' }}</p>
                </div>
                <div class="lg:col-span-2 w-full">
                    <p class="block font-medium text-sm text-gray-700">{{ __('Email') }}</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">{{ $usuario->email ?? 'N/D' }}
                    </p>
                </div>
                @if ($usuario->socio->fecha_fallecido)
                    <div>
                        <p class="block font-medium text-sm text-gray-700">Fecha Fallecido</p>
                        <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                            {{ standart_date_format($usuario->socio->fecha_fallecido) }}</p>
                    </div>
                @endif
            </div>
        </div>

    <details class="mb-4">
        <summary class="w-full text-white bg-blue-800 text-xl p-2">Datos UNEG</summary>
        <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
            <div class="grid lg:grid-cols-6 grid-cols-1 lg:gap-4 gap-2 mx-4">
                <div>
                    <p class="block font-medium text-sm text-gray-700">Fecha Ingreso</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ standart_date_format($usuario->socio->fecha_ingreso_uneg) }}</p>
                </div>
                <div class="lg:col-span-2 w-full">
                    <p class="block font-medium text-sm text-gray-700">Cargo</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ $usuario->socio->cargo?->nombre ?? 'N/D' }}</p>
                </div>
                <div class="lg:col-span-3 w-full">
                    <p class="block font-medium text-sm text-gray-700">Departamento</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ $usuario->socio->departamento?->nombre ?? 'N/D' }}</p>
                </div>
            </div>
            <div class="grid lg:grid-cols-4 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2">
                <div>
                    <p class="block font-medium text-sm text-gray-700">Tipo de empleado</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ $usuario->socio->tipo_trabajador?->nombre ?? 'N/D' }}</p>
                </div>
                <div>
                    <p class="block font-medium text-sm text-gray-700">Condición</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ $usuario->socio->relacion_laboral?->nombre ?? 'N/D' }}</p>
                </div>
                <div>
                    <p class="block font-medium text-sm text-gray-700">Sede</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ $usuario->socio->sede?->nombre ?? 'N/D' }}</p>
                </div>
                <div>
                    <p class="block font-medium text-sm text-gray-700">Sueldo</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ $usuario->socio->sueldo ? number_format($usuario->socio->sueldo, 2, ',', '.') : 'N/D' }} {{ $usuario->socio->sueldo ? $usuario->socio->moneda->abreviatura : '' }}</p>
                </div>
            </div>
            <div class="mx-4 mt-2 grid lg:grid-cols-3 gap-4 mb-2">

                <div>
                    <p class="block font-medium text-sm text-gray-700">Zona</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ $usuario->socio->zona?->nombre ?? 'N/D' }}</p>
                </div>
                @if ($usuario->socio->fecha_retiro_uneg)
                    <div>
                        <p class="block font-medium text-sm text-gray-700">Fecha de retiro</p>
                        <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                            {{ standart_date_format($usuario->socio->fecha_retiro_uneg) }}</p>
                    </div>
                @endif
            </div>
        </div>
    </details>

    @if ($usuario->socio->historico_fichas->isNotEmpty())
        <details class="mb-4">
            <summary class="w-full text-white bg-blue-800 text-xl p-2">Historico de Fichas</summary>
            @foreach ($usuario->socio->historico_fichas as $ficha)
                <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
                    <div class="grid lg:grid-cols-3 grid-cols-1 lg:gap-4 gap-2 mx-4">
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Ficha</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $ficha->ficha_anterior }}</p>
                        </div>
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Cargo</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $ficha->cargo?->nombre ?? 'N/D' }}</p>
                        </div>
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Departamento</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $ficha->departamento?->nombre ?? 'N/D' }}</p>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-3 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2">
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Tipo de empleado</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $ficha->tipo_trabajador?->nombre ?? 'N/D' }}</p>
                        </div>
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Condición</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $ficha->relacion_laboral?->nombre ?? 'N/D' }}</p>
                        </div>
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Sueldo</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $ficha->sueldo ?? 'N/D' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </details>
    @endif

    <details class="mb-4">
        <summary class="w-full text-white bg-blue-800 text-xl p-2">Datos CAUNEG</summary>
        <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300 mb-2">
            <div class="grid lg:grid-cols-3 grid-cols-1 lg:gap-4 gap-3 mx-4">
                <div>
                    <p class="block font-medium text-sm text-gray-700">Saldo Haberes</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200 ">
                        {{ number_format($usuario->socio->saldo_haberes, 2, ',', '.') }} {{ $usuario->socio->moneda->abreviatura }}</p>
                </div>
                <div>
                    <p class="block font-medium text-sm text-gray-700">Saldo Bloqueado</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ number_format($usuario->socio->saldo_bloqueado, 2, ',', '.') }} {{ $usuario->socio->moneda->abreviatura }}</p>
                </div>
                <div>
                    <p class="block font-medium text-sm text-gray-700">Fecha Ingreso</p>
                    <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                        {{ standart_date_format($usuario->socio->fecha_ingreso_cauneg) }}</p>
                </div>
                @if ($usuario->socio->fecha_retiro_cauneg)
                    <div>
                        <p class="block font-medium text-sm text-gray-700">Fecha de retiro</p>
                        <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                            {{ standart_date_format($usuario->socio->fecha_retiro_cauneg) }}</p>
                    </div>
                @endif
            </div>
            <div class="flex items-center gap-2 mb-2 lg:mb-0 mx-4 mt-2">
                <input type="checkbox" disabled class="rounded border-gray-300 text-blue-600 shadow-sm w-5 h-5"
                    id="fiador" @checked($usuario->socio->es_fiador)>
                <x-label class="inline" for="fiador">Fiador</x-label>
            </div>
        </div>
    </details>
    <details class="mb-4">
        <summary class="w-full text-white bg-blue-800 text-xl p-2">Datos Beneficiarios</summary>
        <div class="text-lg w-full text-black pb-2 border-2 border-solid border-gray-300">
            @foreach ($usuario->socio->beneficiarios as $beneficiario)
                <div class="mb-4 pb-4 border-b border-gray-300">
                    <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-4 gap-2 mx-4">
                        <div class="lg:col-span-3 w-full">
                            <p class="block font-medium text-sm text-gray-700">Nombres y Apellidos</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $beneficiario->nombre }}</p>
                        </div>
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Fecha de Nacimiento</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ standart_date_format($beneficiario->fecha_nacimiento) }}</p>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 lg:gap-4 grid-cols-1 gap-2 mx-4 mt-2">
                        <div>
                            <p class="block font-medium text-sm text-gray-700">{{ __('Cédula') }}</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $beneficiario->cedula }}</p>
                        </div>
                        <div>
                            <p class="block font-medium text-sm text-gray-700">{{ __('Email') }}</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $beneficiario->email }}</p>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 grid-cols-1 lg:gap-4 gap-2 mx-4 mt-2 mb-2">
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Teléfono</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $beneficiario->telefono }}</p>
                        </div>
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Teléfono secundario</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $beneficiario->telefono_secundario ?? 'N/D' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </details>
    <details class="mb-4">
        <summary class="w-full text-white bg-blue-800 text-xl p-2">Datos Bancarios</summary>
        <div class="text-lg w-full text-black pb-2 border-2 border-solid border-gray-300" id="bancos-section">
            @foreach ($usuario->socio->bancos as $banco_socio)
                <div class="mb-4 pb-4 border-b border-gray-300">
                    <div class="grid lg:grid-cols-3 lg:gap-4 gap-2 mx-4">
                        <div class="lg:col-span-2">
                            <p class="block font-medium text-sm text-gray-700">Banco</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $banco_socio->nombre }} @isset($banco_socio->abreviatura)
                                    ({{ $banco_socio->abreviatura }})
                                @endisset </p>
                        </div>
                        <div>
                            <p class="block font-medium text-sm text-gray-700">Tipo de cuenta</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $banco_socio->pivot->tipo_cuenta }}</p>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-3 lg:gap-4 gap-2 mx-4 mt-2 mb-2">
                        <div class="col-span-2 numero-cuenta-container">
                            <p class="block font-medium text-sm text-gray-700">Número de cuenta</p>
                            <p class="border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-200">
                                {{ $banco_socio->pivot->numero_cuenta }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </details>
    <div class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4">
        <a @if (auth()->user()->is_admin()) href={{ route('usuarios.edit', $usuario->cedula) }}
            @else
                href={{ route('usuario.user.edit', $usuario->cedula) }} @endif
            class="flex items-center justify-center rounded-md bg-blue-400 text-white m-2 hover:bg-blue-800 lg:w-1/3 w-8/12 h-10 text-lg hover:cursor-pointer">
            @if (auth()->user()->is_admin())  Opciones @else Editar @endif
        </a>
    </div>

</x-app-layout>
