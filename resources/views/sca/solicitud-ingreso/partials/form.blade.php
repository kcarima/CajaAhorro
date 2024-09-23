<form action="{{ route('solicitud.ingreso.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    @include('sca.solicitud-ingreso.partials.personales')
    @include('sca.solicitud-ingreso.partials.uneg')
    @include('sca.solicitud-ingreso.partials.bancos')
    @include('sca.solicitud-ingreso.partials.beneficiarios')
    @include('sca.solicitud-ingreso.partials.documentos')

    @include('sca.solicitud-ingreso.partials.footer')

    <template id="error-aside-template">
        <aside class="fixed bottom-2 right-2 error-aside">
            <button type="button" id="error-form" class="relative p-2 hover:border hover:border-gray-100" title="Ir al siguiente error">
                <span class="animate-ping absolute top-0 right-0 inline-flex h-3 w-3 rounded-full bg-red-900 opacity-75 notificacion-alert"></span>
                <svg class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <defs>
                        <linearGradient id="redgradient">
                            <stop offset="0%" stop-color="#e53935" />
                            <stop offset="100%" stop-color="#e35d5b" />
                        </linearGradient>
                    </defs>
                    <path fill="url(#redgradient)" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224c0-17.7-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32z"/>
                </svg>
            </button>
        </aside>
    </template>

</form>
