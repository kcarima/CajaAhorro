<x-app-layout titulo="Editar Cuenta Bancaria">

    @include('sca.cuentas-bancarias.partials.form', ['titulo' => 'Editar Cuenta Bancaria', 'action' => route('cuenta-bancaria.update', $cuenta->uuid)])

</x-app-layout>
