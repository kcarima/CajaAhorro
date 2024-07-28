@props(['title', 'content', 'footer', 'header'])

<div x-data="{ open: @entangle($attributes->wire('model')).live }" x-show="open" x-cloak class="fixed z-[10000] lg:-inset-20 inset-0">

    <div class="modal-flex-container flex items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div id="modal-bg-container" class="fixed inset-0 bg-gray-700 bg-opacity-75"></div>

        <!-- Capa oculta usada para centrar el modal  -->
        <div class="modal-space-container hidden sm:inline-block sm:align-middle sm:h-screen"></div>

        <div id="modal-container"
            class="inline-block align-bottom bg-gray-100 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg w-full">

            <div class="modal-wrapper bg-gray-100 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                <div id="modal-header" class="flex justify-end">
                    <button @click="open = false">
                        <svg class="h-4 w-4 fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" />
                        </svg>
                    </button>
                </div>

                <h3 class="text-xl text-center w-full font-bold text-gray-900 mb-3">{{ $title ?? '' }}</h3>
                <div class="modal-wrapper-flex">

                    <div class="text-center mt-3 sm:mt-0 sm:text-left">
                        <div class="modal-text">
                            {{ $content ?? '' }}

                        </div>
                    </div>
                </div>

            </div>

            <div
                class="modal-actions bg-gray-200 px-4 py-3 flex justify-end lg:flex-row sm:flex-col-reverse flex-col-reverse lg:gap-2 sm:gap-4 gap-4">
                {{ $footer ?? '' }}
            </div>

        </div>

    </div>
