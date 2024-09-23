<x-app-layout titulo="Registro socio">

    @include('auth.partials.form', ['titulo' => 'Registro de socio', 'action' => route('usuarios.store')])

</x-app-layout>
