<x-app-layout titulo="Reconversion {{ $tabla->descripcion }}">

    <div>
        <header class="mb-4">
            <h1 class="text-center text-3xl">Reconversion Monetaria  {{ $tabla->descripcion }}</h1>
        </header>

        <x-validation-errors />

        <form action="{{ route('reconversion.update', $tabla->uuid) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mx-4 mt-4">
                    <div>
                        <x-label for="moneda1" value="{{ __('Moneda Principal') }}" />
                        <x-input.select name="moneda1" id="moneda1" class="w-full">
                            @foreach ($monedas_modelo as $moneda_m)
                                <option value="{{ $moneda_m->uuid }}" @selected($moneda_m->es_default)>{{ $moneda_m->nombre }} ({{ $moneda_m->abreviatura }}) </option>
                            @endforeach
                        </x-input.select>
                    </div>
                    <div>
                        <x-label for="moneda2" value="{{ __('Moneda Secundaria') }}" />
                        <x-input.select name="moneda2" id="moneda2" class="w-full">
                            <option value=""></option>
                            @foreach ($monedas_conversiones as $moneda_c)
                                <option value="{{ $moneda_c->uuid }}">{{ $moneda_c->nombre }} ({{ $moneda_c->abreviatura }}) </option>
                            @endforeach
                        </x-input.select>
                    </div>
                </div>

                <footer class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4 gap-2 mt-4">
                    <button type="button" onclick="history.back();"
                        class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Cancelar</button>
                    <button type="submit" class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg">Enviar</button>
                </footer>
            </div>

        </form>

    </div>


</x-app-layout>
