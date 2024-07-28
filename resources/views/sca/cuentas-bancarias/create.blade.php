<x-app-layout titulo="Registro Cuenta Bancaria">

    @include('sca.cuentas-bancarias.partials.form', ['titulo' => 'Registro de Cuenta Bancaria', 'action' => route('cuenta-bancaria.store')])

</x-app-layout>
