<div class="bg-inherit min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    @isset($logo)
        <div>
            {{ $logo }}
        </div>
    @endisset

    <div class="@isset($logo) mt-4 @endisset text-3xl font-bold text-center">
        {{ $titulo ?? '' }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
