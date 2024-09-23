<x-app-layout titulo="Usuarios">

    @push('search')
        <x-utils.buscador modulo="usuarios" />
    @endpush

    <div class="w-full flex justify-end">
        <a href="{{ route('usuarios.create') }}" class="flex gap-2 rounded-md bg-white shadow-md p-2 items-center mb-4 hover:shadow-lg hover:cursor-pointer">
            <svg class="w-3 fill-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
            <span class="text-gray-700">Agregar</span>
        </a>
    </div>

    @livewire('seguridad.usuarios.usuarios-component')

</x-app-layout>
