<x-app-layout titulo="Editar Usuario">

    @section('titulo', 'Editar Usuario')

    @php
        $titulo = "Editar información \"" . ucwords(strtolower($usuario->socio->nombre)) . "\"" . " (" . $usuario->socio->ficha . ")";
    @endphp

        @include('auth.partials.form', ['titulo' => $titulo, 'action' => route('usuarios.update', $usuario->cedula)])

</x-app-layout>
