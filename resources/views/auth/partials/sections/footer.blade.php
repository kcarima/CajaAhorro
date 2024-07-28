<footer class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4 gap-2">
    <button type="button" onclick="history.back();"
        class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Cancelar</button>
    @if ($edit)
        @if ($user_is_admin && auth()->user()->cedula != $usuario->cedula)
            <button type="button" id="reset-password" data-cedula="{{ $usuario->cedula }}"
                data-url="{{ route('usuarios.password.reset') }}"
                class="rounded-md border border-solid border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Reiniciar
                Contraseña</button>
        @endif
        @if (auth()->user()->cedula == $usuario->cedula)
            <x-modal class="lg:w-1/3 w-full h-10 border-yellow-500 border hover:bg-yellow-500">
                <x-slot name="button" class="text-yellow-500 hover:text-white focus:text-white">
                    Cambiar Contraseña
                </x-slot>
                <x-slot name="title">
                    Cambio de Contraseña
                </x-slot>
                <x-slot name="content">
                    <section data-form-error="password-form"></section>
                    <div>
                        <div>
                            <x-label for="current_password" value="Contraseña Actual" />
                            <x-input form="password-form" id="current_password" name="current_password" class="w-full" type="password"
                                required autofocus autocomplete="password" />
                        </div>
                        <div class="mt-4">
                            <x-label for="password" value="Nueva Contraseña" />
                            <x-input form="password-form" id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password_confirmation" value="Confirmar Contraseña" />
                            <x-input form="password-form" id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <button type="button" @click="open = false"
                        class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Cancelar</button>
                    <button type="button" id="btn-change-pass" form="password-form"
                        class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg">Enviar</button>
                </x-slot>
            </x-modal>
        @endif
    @endif
    <button type="button" id="btn-enviar"
        class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg">Enviar</button>
</footer>
