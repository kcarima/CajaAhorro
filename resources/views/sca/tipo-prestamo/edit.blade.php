<x-app-layout titulo="Editar Tipo Prestamo - {{ $tipo->nombre }}">

    @include('sca.tipo-prestamo.partials.form', ['titulo' => "Editar Tipo de Prestamo", 'action' => route('tipo-prestamo.update', $tipo->uuid), 'tipo' => $tipo])

</x-app-layout>
