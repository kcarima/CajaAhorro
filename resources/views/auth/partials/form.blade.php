<div>

    @php
        $edit = isset($usuario);
        $user_is_admin = auth()
            ->user()
            ->is_admin();
    @endphp

    <header class="mb-4">
        <h1 class="text-center text-3xl">{{ $titulo }}</h1>
    </header>

    <x-form.validation-error-template />
    <form id="password-form" action="{{ route('password.user') }}" method="POST"></form>
    <form action="{{ $action }}" method="POST">

        @include('auth.partials.sections.personales')

        @if ($user_is_admin)
            @include('auth.partials.sections.uneg')
            @include('auth.partials.sections.cauneg')
            @include('auth.partials.sections.beneficiarios')
            @include('auth.partials.sections.bancos')
            @include('auth.partials.sections.documentos')
        @endif

        @include('auth.partials.sections.footer')
    </form>

</div>

@if ($user_is_admin)
    @include('auth.partials.templates.bancos')

    @include('auth.partials.templates.beneficiarios')
@endif

@if ($edit)
    @if($user_is_admin)
        @push('scripts')
            @vite(['resources/js/modules/seguridad/usuarios/editar.js'])
        @endpush
    @endif
    @if (auth()->user()->cedula == $usuario->cedula)
        @push('scripts')
            @vite(['resources/js/modules/seguridad/usuarios/editar-user.js'])
        @endpush
    @endif
@else
    @push('scripts')
        @vite(['resources/js/modules/seguridad/usuarios/registro.js'])
    @endpush
@endif
