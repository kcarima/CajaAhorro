<x-app-layout titulo="Registro Tipo de Prestamo">

    @include('sca.tipo-prestamo.partials.form', ['titulo' => 'Registro de Tipos de Prestamos', 'action' => route('tipo-prestamo.store')])

</x-app-layout>
